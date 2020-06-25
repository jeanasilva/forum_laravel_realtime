<template>
    <div>
        <div class="card horizontal" v-for="data in replies" :class="{ 'blue-grey lighten-4': data.highlighted }">

            <div class="card-panel lighten-1 z-depth-1">
                <div class="card-images">
                    <img :src="data.user.photo_url" class="circle responsive-img" width="120">
                </div>
            </div>

            <div class="card-stacked">
                <div class="card-content">
                    <span class="card-title"> {{ data.user.name }} {{ replied }}</span>

                        <blockquote>
                            {{ data.body }}
                        </blockquote>

                </div>
                    <div class="card-action" v-if="data.user.role === 'admin'">
                        <a :href="'/reply/highlight/' + data.id">em destaque</a>
                    </div>
                </div>
            </div>

        <div class="card grey lighten-4" v-if="is_closed == 0">

            <div class="card-content">
                <span class="card-title">
                    {{ reply }}
                </span>

                <form @submit.prevent="save()">
                    <div class="input-field">
                        <textarea rows="10" class="materialize-textarea" :placeholder="yourAnswer" v-model="reply_to_save.body"></textarea>
                    </div>
                    <button type="submit" class="btn red accent-2">{{ send }}</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'replied',
            'reply',
            'yourAnswer',
            'send',
            'threadId',
            'isClosed'
        ],

        data(){
            return {
                replies: [],
                thread_id: this.threadId,
                is_closed: this.isClosed,
                reply_to_save: {
                    body: '',
                    thread_id: this.threadId,
                }
            }
        },

        methods: {
            save(){
                axios.post('/replies' , this.reply_to_save).then(() => {
                    this.getReplies()
                })
            },

            getReplies() {
                axios.get('/replies/' + this.thread_id).then((response) => {
                    this.replies = response.data
                })
            }
        },

        mounted() {
            this.getReplies()

            Echo.channel('new.reply.' + this.thread_id)
                .listen('NewReply', (e) => {
                    console.log(e)
                    if (e.reply) {
                        this.getReplies()
                    }
                });
        }
    }
</script>

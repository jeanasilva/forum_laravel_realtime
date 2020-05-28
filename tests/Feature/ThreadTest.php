<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ThreadTest extends TestCase
{

    use DatabaseMigrations;

    public function testActionIndexOnController(){

        $user = factory(\App\User::class)->create();
        $this->seed('ThreadsTableSeeder');

        $threads = Thread::orderByDesc('updated_at')
            ->paginate(15);

        $response = $this
            ->actingAs($user)
            ->json('GET','/threads');

        $response->assertStatus(200)
            ->assertJsonFragment([$threads->toArray()['data']]);

    }

    public function testActionStoreOnController(){

        $user = factory(\App\User::class)->create();

        $response = $this
            ->actingAs($user)
            ->json('POST','/threads', [
                'title'=> 'Meu primeiro Tópico',
                'body' => 'Este é um exemplo de Tópico'
            ]);

        $thread = Thread::find(1);

        $response->assertStatus(200)
            ->assertJsonFragment(['created' => 'sucess'])
            ->assertJsonFragment([$thread->toArray()]);

    }

    public function testActionUpdateOnController(){

        $user   = factory(\App\User::class)->create();
        $thread = factory(\App\Thread::class)->create(
            [
                'user_id' => $user->id
            ]
        );

        $response = $this
            ->actingAs($user)
            ->json('PUT','/threads/' . $thread->id, [
                'title'=> 'Meu primeiro Tópico Atualizado',
                'body' => 'Este é um exemplo de Tópico Atualizado'
            ]);

        $thread->title = 'Meu primeiro Tópico Atualizado';
        $thread->body = 'Este é um exemplo de Tópico Atualizado';


        $response->assertStatus(302);
        $this->assertEquals(Thread::find(1)->toArray(), $thread->toArray());

    }


}

@extends('layouts.default')

@section('content')

<div class="container">
    <h3>
        {{ $result->title }}
    </h3>

    <div class="card grey lighten-4">
        <div class="card-content">
            {{ $result->body }}
        </div>
    </div>

    <replies
        replied="{{ __('Replied') }}"
        reply="{{ __('Reply') }}"
        your-answer="{{ __('Your Answer') }}"
        send="{{ __('Send') }}"
    >
        @include('layouts.default.preloader')
    </replies>

</div>

<script src="/js/replies.js"></script>
@endsection

@extends('layouts.default')

@section('content')

<div class="container">
    <h3>
        {{ __('Most Rescent Threads') }}
    </h3>
    <threads
        title="{{ __('Threads') }}"
        threads="{{ __('Threads') }}"
        replies="{{ __('Replies') }}"
        date="{{ __('Date') }}"
        options="{{ __('Options') }}"
        open="{{ __('Open') }}"
        new-thread="{{ __('New Thread') }}"
        thread-title="{{ __('Title') }}"
        thread-body="{{ __('Body') }}"
        send="{{ __('Send') }}"
    >
        @include('layouts.default.preloader')
    </threads>

</div>

<script type="application/javascript" src="/js/threads.js"></script>
@endsection

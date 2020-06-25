<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('threads.index');
});

Route::get('/threads/{id}', function ($id) {
    $result = \App\Thread::findOrFail($id);
    return view('threads.view', compact('result'));
});

Route::get('/locale/{locale}', function ($locale) {
    session(['locale' => $locale]);
    return back();
});

Route::get('/login/{provider}','SocialAuthController@redirect');
Route::get('/login/{provider}/callback','SocialAuthController@callback');

Route::get('/threads','ThreadController@index');
Route::get('/replies/{id}','RepliesController@show');

Route::middleware(['auth'])
    ->group(function (){
        Route::post('/threads','ThreadController@store');
        Route::put('/threads/{thread}','ThreadController@update');
        Route::get('/threads/{thread}/edit',function (\App\Thread $thread) {
            return view('threads.edit', compact('thread'));
        });

        Route::get('/reply/highlight/{id}','RepliesController@highlight');
        Route::get('/thread/pin/{thread}','ThreadController@pin');
        Route::get('/thread/close/{thread}','ThreadController@close');

        Route::get('/profile','ProfileController@edit');
        Route::post('/profile','ProfileController@update');

        Route::post('/replies','RepliesController@store');

    });

Auth::routes();

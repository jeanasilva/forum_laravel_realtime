<?php

namespace App\Providers;

use App\Reply;
use App\Observers\ReplyObserver;
use App\User;
use App\Observers\PhotoUserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        setlocale(LC_TIME, 'pt-br');

        Reply::observe(ReplyObserver::class);
        User::observe(PhotoUserObserver::class);

    }
}

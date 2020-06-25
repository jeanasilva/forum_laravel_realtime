<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Thread;

class ThreadPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Thread $thread){

        return $user->id === $thread->user_id;
    }


    public function isAdmin(User $user, Thread $thread){

        return $user->role === 'admin';
    }

}

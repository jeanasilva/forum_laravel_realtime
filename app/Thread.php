<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Thread extends Model
{

    public function dateFormat($user,$data){


        $user =  User::find(1);
        $data = $user->created_at->format('d/m/Y');
        dd($data);

    }

}

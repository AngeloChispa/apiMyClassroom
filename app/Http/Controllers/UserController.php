<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function users(int $role){
        return response()->json(User::where('role_id',$role)->get()->makeHidden(['password']));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function users(int $role){
        return response()->json(User::where('role_id',$role)->get()->makeHidden(['password']));
    }

    public function subjects(){
        $user = auth()->user();
        $subjects = $user->subjects()->with('career')->get();
        return response()->json([
            'subjects' => $subjects->all(),
        ],201);
    }
}

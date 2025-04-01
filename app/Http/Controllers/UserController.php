<?php

namespace App\Http\Controllers;

use App\Models\Subject;
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

    public function usersOnSubject(int $id){
        $subject = Subject::findOrFail($id);
        $users = $subject->users;
        return response()->json([
            'users' => $users->all()
        ],201);
    }

}

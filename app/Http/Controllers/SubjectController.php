<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\SubjectRequest;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function store(SubjectRequest $request){
        $subject = new Subject();

        $subject->name = $request->name;
        $subject->description = $request->description;
        $subject->career_id = $request->career_id;
        $subject->grade = $request->grade;
        $subject->users()->syncWithoutDetaching($request->input('user_id'));
        $subject->save();

        return response()->json([
            'success' => true,
            'data' => $request->all()
        ], 201);

    }

    public function addUsers(AddUserRequest $request){
        $subject = Subject::findOrFail($request->input('subject'));

        $subject->users()->syncWithoutDetaching($request->input('users'));
    
        return response()->json([
            'success' => true,
            'data' => $request->all(),
        ],201);
    }

    public function topicsOnSubject(int $id){
        $subject = Subject::findOrFail($id);
        
        $topics = $subject->topics;

        return response()->json([
            'data' => $topics->all()
        ],201);
    }

}

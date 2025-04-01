<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicRequest;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function store(TopicRequest $request){
        $topic = new Topic();

        $topic->name = $request->name;
        $topic->description = $request->description;
        $topic->subject_id = $request->subject;

        $topic->save();

        return response()->json([
            'success' => true,
            'data' => $request->all(),
        ],201);
    }
}

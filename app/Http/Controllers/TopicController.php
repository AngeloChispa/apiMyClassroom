<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicRequest;
use App\Models\Assignment;
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

    public function resourcesOnTopic(int $id){
        $topic = Topic::findOrFail($id);
        $resources = $topic->resources()->with('files','assignment')->orderBy('created_at', 'desc')->get();

        return response()->json([
            $resources->all()
        ],201);
    }
}

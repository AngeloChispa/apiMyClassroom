<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResourceRequest;
use App\Models\Notice;
use App\Models\Resource;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function store(ResourceRequest $request){
        $resource = new Resource();
        $resource->title = $request->title;
        $resource->description = $request->description;
        $resource->topic_id = $request->topic;

        $user = auth()->user();
        $notice = new Notice();

        $notice->message = $user->name . " " . $user->lastname . " ha publicado nuevo material: " . $request->title;
        $notice->date = Carbon::now();
        $notice->subject_id = $request->subject;
        $notice->save();

        $resource->notice_id = $notice->id;

        $resource->save();

        return response()->json([
            'success' => true,
            'data' => $request->all()
        ],201);
        
    }
}

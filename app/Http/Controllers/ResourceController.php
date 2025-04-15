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
        $files = $request->file('files');

        $resource = new Resource();
        $resource->title = $request->input('data.title');
        $resource->description = $request->input('data.description');
        $resource->topic_id = $request->input('data.topic');

        $user = auth()->user();
        $notice = new Notice();

        $notice->message = $user->name . " " . $user->lastname . " ha publicado nuevo material: " . $request->input('data.title');
        $notice->date = Carbon::now();
        $notice->subject_id = $request->input('data.subject');
        $notice->save();

        $resource->notice_id = $notice->id;

        $resource->save();

        if($files){
            /**
             *  Types:
             * 1 = notice
             * 2 = resource
             * 3 = send
             */
            FileController::uploadFiles($files, $resource->id, 2);
        }

        return response()->json([
            'success' => true,
            'data' => $request->all()
        ],201);
    }

    public function recoverResource($id){
        $resource = Resource::findOrFail($id)->with('assignment')->get();
        return response()->json(
            [
                'resource' => $resource
            ]
        );
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignmentRequest;
use App\Http\Requests\EvaluateRequest;
use App\Models\Assignment;
use App\Models\Notice;
use App\Models\Resource;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function store(AssignmentRequest $request)
    {
        $resource = new Resource();

        $resource->title = $request->title;
        $resource->description = $request->description;
        $resource->topic_id = $request->topic;

        $user = auth()->user();
        $notice = new Notice();

        $notice->message = $user->name . " " . $user->lastname . " ha publicado una nueva tarea: " . $request->title;
        $notice->date = Carbon::now();
        $notice->subject_id = $request->subject;
        $notice->save();

        $resource->notice_id = $notice->id;
        $resource->save();

        $assignment = new Assignment();

        $assignment->limit = $request->limit;
        $assignment->resource_id = $resource->id;
        $assignment->save();

        $subject = Subject::findOrFail($request->subject);
        $assignment->users()->syncWithoutDetaching($subject->users()->where('role_id', 2)->select('users.id')->pluck('id')->toArray());

        return response()->json([
            'success' => true,
            'data' => $request->all()
        ], 201);
    }

    /**
     *  0 = Asignado
     *  1 = Calificado
     *  2 = Entregado 
     */
    public function evaluate(EvaluateRequest $request)
    {
        $assignment = Assignment::findOrFail($request->assignment);
        $user = $assignment->users()->where('user_id', $request->student)->first();
        //dd(json_encode($user));

        $user->pivot->status = 1;
        $user->pivot->grades = $request->grade;
        $user->pivot->graded = 1;

        $user->pivot->save();
        return response()->json(
            [
                'success' => true,
                'data' => $request->all(),
            ],200
        );
    }

    public function noGradedAssigns($id)
    {
        $assignments = Assignment::findOrFail($id)->where('graded', 0);
        dd($assignments);
    }
}

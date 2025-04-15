<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignmentRequest;
use App\Http\Requests\EvaluateRequest;
use App\Http\Requests\SendRequest;
use App\Models\Assignment;
use App\Models\File;
use App\Models\Notice;
use App\Models\Resource;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function store(AssignmentRequest $request)
    {
        $files = $request->file('files');

        $resource = new Resource();

        $resource->title = $request->input('data.title');
        $resource->description = $request->input('data.description');
        $resource->topic_id = $request->input('data.topic');

        $user = auth()->user();
        $notice = new Notice();

        $notice->message = $user->name . " " . $user->lastname . " ha publicado una nueva tarea: " . $request->input('data.title');
        $notice->date = Carbon::now();
        $notice->subject_id = $request->input('data.subject');
        $notice->save();

        $resource->notice_id = $notice->id;
        $resource->save();

        $assignment = new Assignment();

        $assignment->limit = $request->input('data.limit');
        $assignment->resource_id = $resource->id;
        $assignment->save();

        $subject = Subject::findOrFail($request->input('data.subject'));
        $assignment->users()->syncWithoutDetaching($subject->users()->where('role_id', 2)->select('users.id')->pluck('id')->toArray());

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

    /**
     *  0 = Asignado
     *  1 = Calificado
     *  2 = Entregado 
     */
    public function noGradedAssigns($id)
    {
        $assignment = Assignment::findOrFail($id);
        $users = $assignment->users()->where('status',2)->get();
        $files = File::where('id',$assignment->id)->get();
        dd(json_encode($files));
    }


    /**
     *  0 = Asignado
     *  1 = Calificado
     *  2 = Entregado 
     */
    public function sendWork(SendRequest $request){
        $user = auth()->user();
        $files = $request->file('files');
        $assignment = $user->assignments()->where('assignment_id',$request->input('data.assign'))->first();
        $assignment->pivot->status = 2;

        $assignment->pivot->save();
        /**
         *  Types:
         * 1 = notice
         * 2 = resource
         * 3 = send
         */
        FileController::uploadFiles($files,$assignment->pivot->id,3);

        return response()->json([
            'success' => true,
            $request->all(),
        ],201);
    }


    /**
     *  0 = Asignado
     *  1 = Calificado
     *  2 = Entregado 
     */
    public function pendings(){
        $user = auth()->user();
        $earrings = $user->assignments()->with('resource')->wherePivot('status',0)->orderBy('limit', 'asc')->get();
        
        return response()->json([
            $earrings->all()
        ],200);
    }
     
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoticeRequest;
use App\Models\Notice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NoticeController extends Controller
{

    public function notices(int $id)
    {
        return response()->json(Notice::where('subject_id', $id)->with('files')->get());
    }

    public function store(NoticeRequest $request)
    {
        $notice = new Notice();
        $files = $request->file('files');

        $notice->message = $request->input('data.message');
        $notice->date = Carbon::now();
        $notice->subject_id = $request->input('data.subject');

        $notice->save();


        if ($files) {
            /**
             *  Types:
             * 1 = notice
             * 2 = resource
             * 3 = send
             */
            FileController::uploadFiles($files, $notice->id, 1);
        }

        return response()->json([
            'success' => true,
            'data' => $request->all()
        ], 201);
    }
}

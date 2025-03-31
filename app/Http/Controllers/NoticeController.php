<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoticeRequest;
use App\Models\Notice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function store(NoticeRequest $request){
        $notice = new Notice();

        $notice->message = $request->message;
        $notice->date = Carbon::now();
        $notice->subject_id = $request->subject;

        $notice->save();

        return response()->json([
            'success' => true,
            'data' => $request->all()
        ], 201);
    }
}

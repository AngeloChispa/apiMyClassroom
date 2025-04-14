<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Models\File;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FileController extends Controller
{

    public static function uploadFiles($files,$id,$type){

        /**
         *  Types:
         * 1 = notice
         * 2 = resource
         * 3 = send
         */

        foreach($files as $file){
            $object = new File();
            $timestamp = Carbon::now()->format('Y-m-d_H-i-s');
            $filename = $file->getClientOriginalName() . '_' . $timestamp;

            $object->originalName = $file->getClientOriginalName();
            $object->path = $filename;

            if($type === 1){
                $object->notice_id = $id;
            }else if($type === 2){
                $object->resource_id = $id;
            }else{
                $object->send_id = $id;
            }
            
            $file->storeAs('', $filename, 'external_storage');
            $object->save();
        }

    }

    /* public static function uploadFiles(FileRequest $request)
    {
        $files = $request->file('files');
        $data = json_decode($request->input('data'));
        //dd($data);
        foreach ($files as $file) {
            $object = new File();
            $timestamp = Carbon::now()->format('Y-m-d_H-i-s');
            $filename = $file->getClientOriginalName() . '_' . $timestamp;
            
            $object->originalName = $file->getClientOriginalName();
            $object->path = $filename;
            $object->notice_id = $data->notice ?? null;

            $object->resource_id = $data->resource ?? null;

            $object->send_id = $data->send ?? null;

            if (!$object->notice_id && !$object->resource_id) {
                return response()->json(['error3' => 'Forbidden'], 403);
            }

            $file->storeAs('', $filename, 'external_storage');
            $object->save();
        }

        return response()->json([
            'success' => true,
            'data' => $data,
        ], 201);
    } */
}

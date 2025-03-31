<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Models\File;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function uploadFiles(FileRequest $request)
    {
        $files = $request->file('files');
        $data = json_decode($request->input('data'), true);
        //dd($data);
        foreach ($files as $file) {
            $object = new File();
            $timestamp = Carbon::now()->format('Y-m-d_H-i-s'); // Formato seguro para nombres de archivo
            $filename = $file->getClientOriginalName() . '_' . $timestamp;
            

            $object->path = $filename;
            $object->notice_id = $data['notice'] ?? null;

            $object->resource_id = $data['resource'] ?? null;


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
    }
}

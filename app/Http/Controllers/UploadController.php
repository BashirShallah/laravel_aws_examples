<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function form(){
        return view('upload_form');
    }

    public function save(Request $request){
        $request->validate([
            'file' => 'required|mimes:png,jpg,gif|max:2048'
        ]);

        $path = $request->file('file')
            ->storePublicly('images', 's3');

        $url = Storage::disk('s3')->url($path);

        return view('upload_result')->with('url', $url);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    public function store(Request $request)
    {

        $file=$request->file('file');
        $fileName = time() . $file->getClientOriginalName();
        $path = $file->storeAs('public/images', $fileName);

        $path = Storage::url($path);

        echo json_encode(['location' => $path]);

    }

}

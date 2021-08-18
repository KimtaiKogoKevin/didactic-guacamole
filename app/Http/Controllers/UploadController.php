<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    //

    public function store(Request $request){
        if ($request->hasFile('photo')){
            $file = $request->file('photo');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('photo/tmp'.$folder,$filename);
            return $folder;
        }

        return  '';
    }
}

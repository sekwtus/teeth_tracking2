<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use Image;
use Hash;

class testcontroller extends Controller
{
    public function savephoto(Request $request) {


        // $image = $request->image;  // your base64 encoded
        // $image = str_replace('data:image/png;base64,', '', $image);
        // $image = str_replace(' ', '+', $image);
        // $imageName = Auth::user()->username .'_'. $request->id .'_'. Carbon::now()->toDateString() .'_' . str_random(8) .'.'.'png';
        // \File::put(public_path('/file'). '/' . $imageName, base64_decode($image));

        // $file = Input::file('image');
        // $photo = $file->getClientOriginalName();
        // $request->file('image')->move(public_path('/file'), $photo);


        $img = $_POST['image'];
        $folderPath = public_path('/file/');

        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';

        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);

        // print_r($fileName);


        return $request->image;
        // return $request->all();
       }
}

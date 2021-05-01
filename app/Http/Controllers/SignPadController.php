<?php

namespace App\Http\Controllers;

use App\Models\Sing;
use Illuminate\Http\Request;

class SignPadController extends Controller
{
    /**
     * index
     */
    public function index()
    {
        $sings = Sing::all();

        return view('sign_pad', compact('sings'));
    }

    /**
     * save
     */
    public function save(Request $request)
    {
        $folderPath = public_path('uploads/');
        $image_parts = explode(";base64,", $request->signed);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $folderPath . uniqid() . '.' . $image_type;
        file_put_contents($file, $image_base64);

        $sing = new Sing();
        $sing['image'] = $file;
        $sing->save();

        return back()->with('success', 'Successfully saved the signature');
    }
}

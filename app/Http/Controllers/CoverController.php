<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cover;

class CoverController extends Controller
{
    public function init_path() {
        $path = "public/uploads/cover-image";

        return $path;
    }


    public function store(Request $request) {
        $request->validate([
            'cover_image' => 'required|image',
        ]);

        $image = $request->file('cover_image');
        if ($image){
            $imageName=Str::slug($request->name).uniqid().'.'.$image->getClientOriginalExtension();
            $request->file('cover_image')->storeAs($this->init_path(),$imageName);
        }

        Cover::create([
            'user_id' => Auth::user()->id,
            'image' => $imageName
        ]);

        return redirect()->route('user.dashboard')->with('msg','You have successfully upload cover image.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cover;

class CoverController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $cover = new Cover();
        $imageName = time().'.'.$request->cover_image->extension();
        $request->cover_image->move(public_path('uploads/cover'), $imageName);

        $cover->user_id = Auth::user()->id;
        $cover->image = $imageName;

        $cover->save();

        return redirect('/dashboard')->with('msg','You have successfully upload image.');
    }
}

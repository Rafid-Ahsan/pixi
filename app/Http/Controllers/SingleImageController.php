<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\SingleImage;
use App\Models\Cover;

class SingleImageController extends Controller
{
    public function init_cover() {
        $user = Cover::where('user_id', Auth::user()->id)->first();

        return $user;
    }

    public function create() {
        return view('dashboard.single.form', [
            'user'=> $this->init_cover()
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'image' => 'required|image',
        ]);

        $path = "public/uploads/single-image";
        $image = $request->file('image');
        if ($image){
            $imageName=Str::slug($request->name).uniqid().'.'.$image->getClientOriginalExtension();
            $request->file('image')->storeAs($path,$imageName);
        }


        SingleImage::create([
            'title' => $request->input('name'),
            'description' => $request->input('description'),
            'user_id' => Auth::user()->id,
            'team_id' => Auth::user()->currentTeam->id,
            'image' => $imageName
        ]);

        return redirect()->route('user.dashboard')->with('msg','You have successfully upload image.');
    }

    public function show() {
        return view('dashboard.single.all');
    }
}

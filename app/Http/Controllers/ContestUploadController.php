<?php

namespace App\Http\Controllers;

use App\Models\ContestUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContestUploadController extends Controller
{
    public function init_path() {
        $path = "public/uploads/contest";

        return $path;
    }

    public function store(Request $request) {
        $request->validate([
            'image' => 'required | image'
        ]);

        $image = $request->file('image');
        if ($image){
            $imageName=Str::slug($request->name).uniqid().'.'.$image->getClientOriginalExtension();
            $request->file('image')->storeAs($this->init_path(),$imageName);
        }

        if($request->publisher_id == $request->participator_id) {
            return redirect()->route('contest.index')->with('success', 'You crazy!!! You are submitting on your own Contest');
        }   else {
            ContestUpload::create([
                'contest_id' => $request->contest_id,
                'publisher_id' => $request->publisher_id,
                'participator_id' => $request->participator_id,
                'image' => $imageName
            ]);

            return redirect()->route('contest.index')->with('success', 'Successfully Uploaded Pic on this Contest');
        }

    }
}

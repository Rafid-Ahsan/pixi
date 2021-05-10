<?php

namespace App\Http\Controllers;

use App\Models\ContestUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function submissions(Request $request) {
        $contest = ContestUpload::where('contest_id', $request->id)->first();

        $participants = DB::table('users')
            ->join('contest_uploads', 'users.id', '=', 'contest_uploads.participator_id')
            ->select('contest_uploads.id as image_id', 'users.*', 'contest_uploads.*')
            ->get();

        return view('contest.submissions', [
            'contest' => $contest,
            'participants' => $participants
        ]);
    }

    public function show_image(Request $request) {
        $contest = ContestUpload::where('id', $request->id)->first();

        return view('contest.image', [
            'contest' => $contest
        ]);
    }

    public function update_status(Request $request) {
        $contest = ContestUpload::where('participator_id', $request->id)->first();

        $contest->update([
            'status' => $request->status
        ]);

        return redirect()->route('contest.index')->with('success', 'You have Changed the status');
    }
}

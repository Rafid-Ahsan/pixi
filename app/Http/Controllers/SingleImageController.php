<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Models\SingleImage;
use App\Models\Cover;

class SingleImageController extends Controller
{
    public function init_cover() {
        $user = Cover::where('user_id', Auth::user()->id)->first();

        return $user;
    }

    public function init_path() {
        $path = "public/uploads/single-image";

        return $path;
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

        $image = $request->file('image');
        if ($image){
            $imageName=Str::slug($request->name).uniqid().'.'.$image->getClientOriginalExtension();
            $request->file('image')->storeAs($this->init_path(),$imageName);
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

    public function show_all() {
        $singles = DB::table('users')
            ->join('single_images', 'users.id', '=', 'single_images.user_id')
            ->join('teams', 'single_images.team_id', '=', 'teams.id')
            ->where('users.id', Auth::user()->id)
            ->select('single_images.*', 'users.profile_photo_path', 'users.name', 'teams.name as team_name')
            ->orderBy('single_images.created_at', 'desc')
            ->paginate(9);

        return view('dashboard.single.all', [
            'singles' => $singles,
            'user'=> $this->init_cover()
        ]);
    }



    public function show_single(SingleImage $single) {
        return view('dashboard.single.single', [
            'user' => $this->init_cover(),
            'single' => $single
        ]);
    }


    public function show_update_form(SingleImage $single) {
        return view('dashboard.single.updateForm', [
            'user' => $this->init_cover(),
            'single' => $single,
            'teams' => Auth::user()->allTeams()
        ]);
    }



    public function update(Request $request, SingleImage $single) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $single->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'user_id'=>Auth::user()->id,
            'team_id' => $request->team_id
        ]);

        return redirect()->route('single.all')->with('msg','You have successfully update '. $single->title);
    }



    public function delete(Request $request) {
        $single = SingleImage::where('id', $request->id)->first();
        $single->delete();

        return redirect()->route('single.all')->with('msg','You have successfully Delete ' . $single->title);
    }
}

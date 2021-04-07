<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\Catalog;
use App\Models\Cover;

class CatalogImageController extends Controller
{
    public function init_cover() {
        $user = Cover::where('user_id', Auth::user()->id)->first();

        return $user;
    }

    public function init_path() {
        $path = "public/uploads/catalog-image";

        return $path;
    }

    public function create() {
        return view('dashboard.catalog.form', [
            'user'=> $this->init_cover()
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'images' => 'required',
        ]);

        if($request->hasfile('images'))
        {
            foreach($request->file('images') as $image)
            {
                $imageName = Str::slug($request->name).uniqid().'.'.$image->getClientOriginalExtension();
                $image->storeAs($this->init_path(),$imageName);
                $images[] = $imageName;
            }
        }

        Catalog::create([
            'title' => $request->input('name'),
            'user_id' => Auth::user()->id,
            'team_id' => Auth::user()->currentTeam->id,
            'image' => json_encode($images)
        ]);

        return redirect()->route('user.dashboard')->with('msg','You have successfully upload a catalog.');
    }
}

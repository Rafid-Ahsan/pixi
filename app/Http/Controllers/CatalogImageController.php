<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Catalog;
use App\Models\Cover;

class CatalogImageController extends Controller
{
    public function init_cover() {
        $user = Cover::where('user_id', Auth::user()->id)->first();

        return $user;
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

        $catalog = new Catalog();

        if($request->hasfile('images'))
        {
            foreach($request->file('images') as $image)
            {
                $imageName = time().rand(1,100).'.'.$image->extension();
                $image->move(public_path('uploads/catalog_image'), $imageName);
                $images[] = $imageName;
            }
        }

        $catalog->user_id = Auth::user()->id;
        $catalog->image = json_encode($images);

        $catalog->user_id = $request->id;
        $catalog->team_id = Auth::user()->currentTeam->id;
        $catalog->title = $request->name;

        $catalog->save();

        return redirect('/dashboard')->with('msg','You have successfully upload image.');
    }
}

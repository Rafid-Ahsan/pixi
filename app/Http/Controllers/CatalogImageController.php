<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

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
            'price' => 'required'
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
            'image' => json_encode($images),
            'price' => $request->price
        ]);

        return redirect()->route('user.dashboard')->with('msg','You have successfully upload a catalog.');
    }



    public function show_all() {
        $catalogs = DB::table('users')
            ->join('catalogs', 'users.id', '=', 'catalogs.user_id')
            ->join('teams', 'catalogs.team_id', '=', 'teams.id')
            ->where('users.id', Auth::user()->id)
            ->select('catalogs.*', 'users.profile_photo_path', 'users.name', 'teams.name as team_name')
            ->orderBy('catalogs.created_at', 'desc')
            ->paginate(9);

        return view('dashboard.catalog.all', [
            'catalogs' => $catalogs,
            'user'=> $this->init_cover()
        ]);
    }



    public function show_single(Catalog $catalog) {
        return view('dashboard.catalog.single', [
            'user' => $this->init_cover(),
            'catalog' => $catalog
        ]);
    }



    public function show_update_form(Catalog $catalog) {
        return view('dashboard.catalog.updateForm', [
            'user' => $this->init_cover(),
            'catalog' => $catalog,
            'teams' => Auth::user()->allTeams()
        ]);
    }



    public function update(Request $request) {
        $catalog = Catalog::where('id', $request->id)->first();

        $request->validate([
            'title' => 'required'
        ]);

        $catalog->update([
            'title'=>$request->title,
            'team_id' => $request->team_id
        ]);

        return redirect()->route('catalog.all')->with('msg','You have successfully update '. $catalog->title);
    }



    public function delete(Request $request) {
        $catalog = Catalog::findOrFail($request->id);
        $catalog->delete();

        return redirect()->route('catalog.all')->with('msg','You have successfully Delete ' . $catalog->title);
    }
}

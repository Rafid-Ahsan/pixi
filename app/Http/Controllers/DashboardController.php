<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cover;
use App\Models\User;
use App\Models\SingleImage;
use App\Models\BlogImage;
use App\Models\Catalog;

class DashboardController extends Controller
{
    public function init_cover() {
        $user = Cover::where('user_id', Auth::user()->id)->first();

        return $user;
    }

    public function index() {
        $blog = DB::table('users')
            ->join('blog_images', 'users.id', '=', 'blog_images.user_id')
            ->join('teams', 'blog_images.team_id', '=', 'teams.id')
            ->select('blog_images.*', 'users.profile_photo_path', 'users.name', 'teams.name as team_name')
            ->orderBy('blog_images.created_at', 'desc')
            ->first();

        $singles = DB::table('users')
            ->join('single_images', 'users.id', '=', 'single_images.user_id')
            ->join('teams', 'single_images.team_id', '=', 'teams.id')
            ->select('single_images.*', 'users.profile_photo_path', 'users.name', 'teams.name as team_name')
            ->orderBy('single_images.created_at', 'desc')
            ->limit(6)
            ->get();

        $catalogs = DB::table('users')
            ->join('catalogs', 'users.id', '=', 'catalogs.user_id')
            ->join('teams', 'catalogs.team_id', '=', 'teams.id')
            ->select('catalogs.*', 'users.profile_photo_path', 'users.name', 'teams.name as team_name')
            ->orderBy('catalogs.created_at', 'desc')
            ->limit(12)
            ->get();

        return view('dashboard', [
            'user' => $this->init_cover(),
            'blog' => $blog,
            'singles' => $singles,
            'catalogs' => $catalogs
        ]);
    }

    public function create_single_image() {
        return view('dashboard.single_image_form', [
            'user'=> $this->init_cover()
        ]);
    }

    public function store_single_image(Request $request) {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'image' => 'required|image',
        ]);

        $single_image = new SingleImage();
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('uploads/single_image'), $imageName);

        $single_image->user_id = Auth::user()->id;
        $single_image->image = $imageName;

        $single_image->user_id = $request->id;
        $single_image->team_id = Auth::user()->currentTeam->id;
        $single_image->title = $request->name;
        $single_image->description = $request->description;

        $single_image->save();

        return redirect('/dashboard')->with('msg','You have successfully upload image.');
    }

    public function create_blog() {
        return view('dashboard.blog_form', [
            'user'=> $this->init_cover()
        ]);
    }

    public function store_blog(Request $request) {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'images' => 'required',
        ]);

        $blog = new BlogImage();

        if($request->hasfile('images'))
        {
            foreach($request->file('images') as $image)
            {
                $imageName = time().rand(1,100).'.'.$image->extension();
                $image->move(public_path('uploads/blog_image'), $imageName);
                $images[] = $imageName;
            }
        }

        $blog->user_id = Auth::user()->id;
        $blog->image = json_encode($images);

        $blog->user_id = $request->id;
        $blog->team_id = Auth::user()->currentTeam->id;
        $blog->title = $request->name;
        $blog->description = $request->description;

        $blog->save();

        return redirect('/dashboard')->with('msg','You have successfully upload image.');
    }

    public function create_catalog_image() {
        return view('dashboard.catalog_form', [
            'user'=> $this->init_cover()
        ]);
    }

    public function store_catalog(Request $request) {
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

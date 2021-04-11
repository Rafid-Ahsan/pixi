<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Cover;

class WelcomeController extends Controller
{
    public function init_cover() {
        $user = Cover::where('user_id', Auth::user()->id)->first();

        return $user;
    }


    public function init_user() {
        if(Auth::check()) {
            $user = Cover::where('user_id', Auth::user()->id)->first();
            return $user;
        }   else {
            return $user = null;
        }
    }

    public function index() {
        $blog = DB::table('users')
            ->join('blog_images', 'users.id', '=', 'blog_images.user_id')
            ->join('teams', 'blog_images.team_id', '=', 'teams.id')
            ->select('blog_images.*', 'users.profile_photo_path', 'users.name', 'teams.name as team_name')
            ->latest()
            ->first();

        $singles = DB::table('users')
            ->join('single_images', 'users.id', '=', 'single_images.user_id')
            ->join('teams', 'single_images.team_id', '=', 'teams.id')
            ->select('single_images.*', 'users.profile_photo_path', 'users.name', 'teams.name as team_name')
            ->orderBy('single_images.created_at', 'desc')
            ->limit(3)
            ->get();

        $catalogs = DB::table('users')
            ->join('catalogs', 'users.id', '=', 'catalogs.user_id')
            ->join('teams', 'catalogs.team_id', '=', 'teams.id')
            ->select('catalogs.*', 'users.profile_photo_path', 'users.name', 'teams.name as team_name')
            ->orderBy('catalogs.created_at', 'desc')
            ->limit(2)
            ->get();

        return view('welcome', [
            'user' => $this->init_user(),
            'blog' => $blog,
            'singles' => $singles,
            'catalogs' => $catalogs
        ]);
    }

    public function show_all_blogs() {
        $blogs = DB::table('users')
            ->join('blog_images', 'users.id', '=', 'blog_images.user_id')
            ->join('teams', 'blog_images.team_id', '=', 'teams.id')
            ->select('blog_images.*', 'users.profile_photo_path', 'users.name', 'teams.name as team_name')
            ->orderBy('blog_images.created_at', 'desc')
            ->paginate(9);

        return view('dashboard.blog.all', [
            'blogs' => $blogs,
            'user'=> $this->init_cover()
        ]);
    }

    public function show_all_singles() {
        $singles = DB::table('users')
            ->join('single_images', 'users.id', '=', 'single_images.user_id')
            ->join('teams', 'single_images.team_id', '=', 'teams.id')
            ->select('single_images.*', 'users.profile_photo_path', 'users.name', 'teams.name as team_name')
            ->orderBy('single_images.created_at', 'desc')
            ->paginate(9);

        return view('dashboard.single.all', [
            'singles' => $singles,
            'user'=> $this->init_cover()
        ]);
    }

    public function show_all_catalogs() {
        $catalogs = DB::table('users')
            ->join('catalogs', 'users.id', '=', 'catalogs.user_id')
            ->join('teams', 'catalogs.team_id', '=', 'teams.id')
            ->select('catalogs.*', 'users.profile_photo_path', 'users.name', 'teams.name as team_name')
            ->orderBy('catalogs.created_at', 'desc')
            ->paginate(9);

        return view('dashboard.catalog.all', [
            'catalogs' => $catalogs,
            'user'=> $this->init_cover()
        ]);
    }

}

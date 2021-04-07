<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use App\Models\Cover;

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
            ->where('users.id', Auth::user()->id)
            ->select('blog_images.*', 'users.profile_photo_path', 'users.name', 'teams.name as team_name')
            ->orderBy('blog_images.created_at', 'desc')
            ->first();

        $singles = DB::table('users')
            ->join('single_images', 'users.id', '=', 'single_images.user_id')
            ->join('teams', 'single_images.team_id', '=', 'teams.id')
            ->where('users.id', Auth::user()->id)
            ->select('single_images.*', 'users.profile_photo_path', 'users.name', 'teams.name as team_name')
            ->orderBy('single_images.created_at', 'desc')
            ->limit(6)
            ->get();

        $catalogs = DB::table('users')
            ->join('catalogs', 'users.id', '=', 'catalogs.user_id')
            ->join('teams', 'catalogs.team_id', '=', 'teams.id')
            ->where('users.id', Auth::user()->id)
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
}

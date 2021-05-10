<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminImageController extends Controller
{
    public function index() {
        $single_images= DB::table('users')
            ->join('single_images', 'users.id', '=', 'single_images.user_id')
            ->select('single_images.id as single_image_id', 'users.*', 'single_images.*')
            ->get()
            ->toArray();

        $blog_images= DB::table('users')
            ->join('blog_images', 'users.id', '=', 'blog_images.user_id')
            ->select('blog_images.id as blog_image_id', 'users.*', 'blog_images.*')
            ->get()
            ->toArray();

        $catalogs_images= DB::table('users')
            ->join('catalogs', 'users.id', '=', 'catalogs.user_id')
            ->select('catalogs.id as catalog_id', 'users.*', 'catalogs.*')
            ->get()
            ->toArray();

        $users = array_merge($single_images, $blog_images, $catalogs_images);

        return view('admin.image', [
            'users' => $users
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cover;

class UserController extends Controller
{
    public function init_user() {
        if(Auth::check()) {
            $user = Cover::where('user_id', Auth::user()->id)->first();
            return $user;
        }   else {
            return $user = null;
        }
    }

    public function index() {
        return view('welcome', [
            'user' => $this->init_user()
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\BlogImage;
use App\Models\Cover;

class BlogController extends Controller
{
    public function init_cover() {
        $user = Cover::where('user_id', Auth::user()->id)->first();

        return $user;
    }

    public function create() {
        return view('dashboard.blog.form', [
            'user'=> $this->init_cover()
        ]);
    }

    public function store(Request $request) {
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
}

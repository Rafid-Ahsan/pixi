<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Models\BlogImage;
use App\Models\Cover;

class BlogController extends Controller
{
    public function init_cover() {
        $user = Cover::where('user_id', Auth::user()->id)->first();

        return $user;
    }



    public function init_path() {
        $path = "public/uploads/blog-image";

        return $path;
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

        if($request->hasfile('images'))
        {
            foreach($request->file('images') as $image)
            {
                $imageName = Str::slug($request->name).uniqid().'.'.$image->getClientOriginalExtension();
                $image->storeAs($this->init_path(),$imageName);
                $images[] = $imageName;
            }
        }

        BlogImage::create([
            'title' => $request->input('name'),
            'description' => $request->input('description'),
            'user_id' => Auth::user()->id,
            'team_id' => Auth::user()->currentTeam->id,
            'image' => json_encode($images)
        ]);

        return redirect()->route('user.dashboard')->with('msg','You have successfully upload a blog.');
    }


    public function show_all() {
        $blogs = DB::table('users')
            ->join('blog_images', 'users.id', '=', 'blog_images.user_id')
            ->join('teams', 'blog_images.team_id', '=', 'teams.id')
            ->where('users.id', Auth::user()->id)
            ->select('blog_images.*', 'users.profile_photo_path', 'users.name', 'teams.name as team_name')
            ->orderBy('blog_images.created_at', 'desc')
            ->paginate(9);

        return view('dashboard.blog.all', [
            'blogs' => $blogs,
            'user'=> $this->init_cover()
        ]);
    }



    public function show_single(BlogImage $blog) {
        return view('dashboard.blog.single', [
            'user' => $this->init_cover(),
            'blog' => $blog
        ]);
    }



    public function download(BlogImage $blog) {
        $path = $this->init_path()."/".head(json_decode($blog->image));
        return response()->download($path);

    }


    public function show_update_form(BlogImage $blog) {
        return view('dashboard.blog.updateForm', [
            'user' => $this->init_cover(),
            'blog' => $blog,
            'teams' => Auth::user()->allTeams()
        ]);
    }



    public function update(Request $request, BlogImage $blog) {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $blog->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'user_id'=>Auth::user()->id,
            'team_id' => $request->team_id
        ]);

        return redirect()->route('blog.all')->with('msg','You have successfully update '. $blog->title);
    }



    public function delete(Request $request) {
        $blog = BlogImage::where('id', $request->id)->first();
        $blog->delete();

        return redirect()->route('blog.all')->with('msg','You have successfully Delete ' . $blog->title);
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(){
        $blogs = DB::table('blogs')
                ->orderBy('created_at')
                ->where('status',1)
                ->where('trash', 0)
                ->get();
        return view('/admin/pages/blogs/index')->with('blogs',$blogs);
    }

    public function create(){
        return view('/admin/pages/blogs/add_blog');
    }

    public function store(Request $request, $id = null){

        $imageName = null;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->storeAs('public/blog/images', $imageName);
        }
        $description = $request->input('description');

        DB::table('blogs')->updateOrInsert(
            ['id' => $id],
            [
            'url'         => Str::slug($request->title),
            'title'       => $request->title,
            'image'       => $imageName,
            'description' => $description,
            'meta_key'    => $request->meta_key,
            ]
        );
        return redirect()->route('blogs');
    }

    public function edit($id){
        $blog = DB::table('blogs')->where('id',$id)->first();
        return view('/admin/pages/blogs/add_blog')->with('blog',$blog);
    }

    public function destroy($id){
        DB::table('blogs')->where('id', $id)->delete();
        return back();
    }

    public function blogSettings(){
        return view('/admin/pages/blogs/blog_settings');
    }
}

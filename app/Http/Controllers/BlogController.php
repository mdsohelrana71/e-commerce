<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BlogsExport;

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
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->storeAs('public/blog/images', $imageName);
            $data['image'] = $imageName;
        }

        $data['url'] = Str::slug($request->title);
        $data['title'] = $request->title;
        $data['description'] = $request->description;
        $data['status'] = $request->status;
        $data['auth_id'] = Auth::user()->id;
        $data['meta_key'] = $request->meta_key;

        DB::table('blogs')->updateOrInsert(['id' => $id], $data);
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

    public function blogDetails($slug){
        $blog = DB::table('blogs')->where('url',$slug)
                ->leftJoin('users','blogs.auth_id','users.id')
                ->select('blogs.*','users.name')
                ->first();
        return view('/admin/pages/blogs/blog_details')->with('blog',$blog);
    }

    public function blogExport(){
        return Excel::download(new BlogsExport, 'blog-list.xlsx');
    }

    public function blogSettings(){
        return view('/admin/pages/blogs/blog_settings');
    }
}

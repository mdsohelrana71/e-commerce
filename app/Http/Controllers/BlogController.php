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
    public function index($status = null){
        $blogs = DB::table('blogs')->orderBy('created_at');
        if($status !== null){
            $blogs->where('status',$status);
        }else{
            $blogs->where('status',1);
        }
        $blogs = $blogs->where('trash', 0)->paginate(5);
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

    public function blogSearch(Request $request){
        $data = $request['value'];
        $blogs = DB::table('blogs')->where('status',1)->orderBy('created_at')->where('title', 'like', '%' . $data . '%')->where('trash', 0)->paginate(20);
        if($blogs){
            $data_html = '';
            foreach ($blogs as $data){
                $data_html.='<div class="card-body mb-2 blog-card">
                                <div class="row">
                                    <div class="blog-image col-sm-2 col-md-2 col-lg-2">
                                        <img class="card-img-top" src="'. get_image($data->image,'blog').' " alt="">
                                    </div>
                                    <div class="blog-info col-sm-8 col-md-8 col-lg-8">
                                        <a href=" ' . route('blog.details',$data->url) . ' " target="_blank">
                                            <h4 class="blog-title">'. substr($data->title,0,100) . ' </h4>
                                        </a>
                                        <p class="card-text">' . substr(strip_tags($data->description), 0, 250) . '...'. '</p>
                                    </div>
                                    <div class="blog-action col-sm-2 col-md-2 col-lg-2">
                                        <a href="' . route('blog.edit',$data->id) . '" class="btn btn-primary me-2">Edit</a>
                                        <a href="' . route('blog.destroy',$data->id) . '" class="btn btn-danger me-2">Delete</a>
                                        <a href="' . route('blog.details',$data->url) . '" class="btn btn-info" target="_blank">View</a>
                                    </div>
                                </div>
                            </div>';
            }
            $data_html.='<div class="data-pagination">'. $blogs->withQueryString()->links('pagination::bootstrap-5').'</div>';
            return response()->json(['data' => $data_html]);
        }
    }

    public function blogSettings(){
        return view('/admin/pages/blogs/blog_settings');
    }
}

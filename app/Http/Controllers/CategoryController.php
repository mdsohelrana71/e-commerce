<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index($type = null){
        $categories = Category::where('parent_id',0)->with('children')->orderBy('name');
        if($type !== null){
            $categories->where('type',$type);
        }else{
            $categories->where('type',1);
        }
        $categories = $categories->paginate(25);
        return view('/admin/pages/category/index')->with('categories',$categories);
    }

    public function create(){
        $categories = DB::table('categories')->orderBy('name')->where('status',1)->get();
        return view('/admin/pages/category/add_category')->with('categories',$categories);
    }

    public function store(Request $request, $id = null){
        $data['name'] = $request->name;
        $data['slug'] = Str::slug($request->name);
        $data['parent_id'] = $request->parent_id;
        $data['type'] = $request->type;
        DB::table('categories')->updateOrInsert(['id' => $id], $data);
        return redirect()->route('category');
    }

    public function edit($id){
        $categories = DB::table('categories')->orderBy('name')->where('status',1)->get();
        $category = DB::table('categories')->where('id',$id)->first();
        return view('/admin/pages/category/add_category')->with(['category'=>$category,'categories'=>$categories]);
    }

    public function destroy($id){
        DB::table('categories')->where('id', $id)->delete();
        return back();
    }

    public function categorySearch(Request $request){
        $data = $request['value'];
        $categories = Category::where('parent_id',0)->with('children')->orderBy('name')
                    ->where('status',1)->where('name', 'like', '%' . $data . '%')
                    ->paginate(25);
        // dump($categories);
        if($categories){
            $data_html = '';
            foreach ($categories as $data){
                $data_html.='<li class="parent-category">
                    <div class="category">
                        <span class="categoy-title">'. $data->name .'</span>
                        <span class="categoy-action">
                            <a href="'. route('category.edit',$data->id). '" class="btn btn-primary btn-sm me-2">Edit</a>
                            <a href="'. route('category.destroy',$data->id). '" class="btn btn-danger btn-sm me-2">Delete</a>
                        </span>
                    </div>';
                    if ($data->children->count() > 0) {
                        $data_html .= view('admin.pages.category.subcategories', ['categories' => $data->children])->render();
                    }
                '</li>';
            }
            $data_html.='<div class="data-pagination">'. $categories->withQueryString()->links('pagination::bootstrap-5').'</div>';
            return response()->json(['data' => $data_html]);
        }
    }
}

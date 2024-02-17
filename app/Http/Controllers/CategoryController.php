<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index($status = null){
        $categories = DB::table('categories')->orderBy('name');
        if($status !== null){
            $categories->where('status',$status);
        }else{
            $categories->where('status',1);
        }
        $categories = $categories->paginate(25);
        return view('/admin/pages/category/index')->with('categories',$categories);
    }

    public function create(){
        return view('/admin/pages/category/add_category');
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
        $category = DB::table('categories')->where('id',$id)->first();
        return view('/admin/pages/category/add_category')->with('category',$category);
    }

    public function destroy($id){
        DB::table('categories')->where('id', $id)->delete();
        return back();
    }

    public function categorySearch(Request $request){
        $data = $request['value'];
        $categories = DB::table('categories')
                    ->where('status',1)->where('name', 'like', '%' . $data . '%')
                    ->paginate(25);
        if($categories){
            $data_html = '';
            foreach ($categories as $data){
                $data_html.='<div class="card-body mb-2 category-card">
                                <div class="row">
                                    <div class="category-info col-sm-10 col-md-10 col-lg-10">
                                        <h4 class="category-title">'. substr($data->name,0,100) . ' </h4>
                                    </div>
                                    <div class="category-action col-sm-2 col-md-2 col-lg-2">
                                        <a href="' . route('category.edit',$data->id) . '" class="btn btn-primary me-2">Edit</a>
                                        <a href="' . route('category.destroy',$data->id) . '" class="btn btn-danger me-2">Delete</a>
                                    </div>
                                </div>
                            </div>';
            }
            $data_html.='<div class="data-pagination">'. $categories->withQueryString()->links('pagination::bootstrap-5').'</div>';
            return response()->json(['data' => $data_html]);
        }
    }
}

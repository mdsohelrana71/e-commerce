<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index($status = null){
        $products = DB::table('products')->orderBy('created_at');
        if($status !== null){
            $products->where('status',$status);
        }else{
            $products->where('status',1);
        }
        $products = $products->where('status', 0)->paginate(5);
        return view('/admin/pages/product/index')->with('products',$products);
    }

    public function create(){
        return view('/admin/pages/product/add_product');
    }

    public function store(Request $request, $id = null){
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->storeAs('public/product/images', $imageName);
            $data['image'] = $imageName;
        }

        $data['url'] = Str::slug($request->title);
        $data['title'] = $request->title;
        $data['description'] = $request->description;
        $data['status'] = $request->status;
        $data['auth_id'] = Auth::user()->id;
        $data['meta_key'] = $request->meta_key;

        DB::table('products')->updateOrInsert(['id' => $id], $data);
        return redirect()->route('product');
    }

    public function edit($id){
        $product = DB::table('products')->where('id',$id)->first();
        return view('/admin/pages/product/add_product')->with('product',$product);
    }

    public function destroy($id){
        DB::table('products')->where('id', $id)->delete();
        return back();
    }

    public function productDetails($slug){
        $product = DB::table('products')->where('url',$slug)
                ->leftJoin('users','products.auth_id','users.id')
                ->select('products.*','users.name')
                ->first();
        return view('/admin/pages/product/product_details')->with('product',$product);
    }


    public function productSearch(Request $request){
        $data = $request['value'];
        $products = DB::table('products')->where('status',1)->orderBy('created_at')->where('title', 'like', '%' . $data . '%')->where('trash', 0)->paginate(2);
        if($products){
            $data_html = '';
            foreach ($products as $data){
                $data_html.='<div class="card-body mb-2 product-card">
                                <div class="row">
                                    <div class="product-image col-sm-2 col-md-2 col-lg-2">
                                        <img class="card-img-top" src="'. get_image($data->image,'product').' " alt="">
                                    </div>
                                    <div class="product-info col-sm-8 col-md-8 col-lg-8">
                                        <a href=" ' . route('product.details',$data->url) . ' " target="_blank">
                                            <h4 class="product-title">'. substr($data->title,0,100) . ' </h4>
                                        </a>
                                        <p class="card-text">' . substr(strip_tags($data->description), 0, 250) . '...'. '</p>
                                    </div>
                                    <div class="product-action col-sm-2 col-md-2 col-lg-2">
                                        <a href="' . route('product.edit',$data->id) . '" class="btn btn-primary me-2">Edit</a>
                                        <a href="' . route('product.destroy',$data->id) . '" class="btn btn-danger me-2">Delete</a>
                                        <a href="' . route('product.details',$data->url) . '" class="btn btn-info" target="_blank">View</a>
                                    </div>
                                </div>
                            </div>';
            }
            $data_html.='<div class="data-pagination">'. $products->withQueryString()->links('pagination::bootstrap-5').'</div>';
            return response()->json(['data' => $data_html]);
        }
    }

    public function productSettings(){
        return view('/admin/pages/product/product_settings');
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index($status = null){
        $products = DB::table('products')->orderBy('created_at');
        if($status !== null){
            $products->where('products.status',$status);
        }else{
            $products->where('products.status',1);
        }
        $products->leftJoin('images', 'products.id', 'images.content_id')
                ->leftJoin('categories_items', 'products.id', 'categories_items.content_id')
                ->leftJoin('categories', 'categories_items.category_id', 'categories.id')
                ->select('products.*', 'images.image', DB::raw("GROUP_CONCAT(categories.name SEPARATOR ', ') AS category_names"))
                ->groupBy('products.id', 'images.image');
        $products = $products->paginate(10);
        return view('/admin/pages/product/index')->with('products',$products);
    }

    public function create(){
        $categories = DB::table('categories')->where('status',1)->where('type',1)->get();
        return view('/admin/pages/product/add_product')->with('categories',$categories);
    }

    public function store(Request $request, $id = null){

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric',
            'category'    => 'required',
            'shipping_price' => 'required|numeric',
            'quantity'    => 'required|integer',
            'status'      => 'required',
            'ean'         => 'required|integer|min:8',
            'offer'       => 'nullable|numeric',
            'max_quantity_per_order' => 'nullable|integer',
            'item_size'   => 'nullable|string|max:255',
            'item_unit'   => 'nullable|string|max:255',
            'item_color'  => 'nullable|string|max:255',
            'item_materials' => 'nullable|string|max:255',
            'delivery_days'=> 'nullable|integer',
            'meta_key'    => 'nullable|string|max:255',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data['url'] = Str::slug($request->title);
        $data['title'] = $request->title;
        $data['description'] = $request->description;
        $data['price'] = $request->price;
        $data['offer'] = $request->offer;
        $data['shipping'] = $request->shipping_price;
        $data['quantity'] = $request->quantity;
        $data['brand'] = $request->brand;
        $data['max_quantity_per_order'] = $request->max_quantity_per_order;
        $data['item_size'] = $request->item_size;
        $data['item_weight'] = $request->item_weight;
        $data['item_unit'] = $request->item_unit;
        $data['item_color'] = $request->item_color;
        $data['materials'] = $request->item_materials;
        $data['gender'] = $request->item_gender;
        $data['status'] = $request->status;
        $data['delivery_days'] = $request->delivery_days;
        $data['ean'] = $request->ean;
        $data['auth_id'] = Auth::user()->id;
        $data['meta_key'] = $request->meta_key;

        DB::table('products')->updateOrInsert(['id' => $id], $data);
        if(!$id){
            $productId = DB::getPdo()->lastInsertId();
        }else {
            $productId = $id;
        }
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->storeAs('public/product/images', $imageName);
            $image_data = [
                'image' => $imageName,
                'content_id' => $productId,
                'type' => 'product'
            ];
            DB::table('images')->updateOrInsert(['content_id' => $productId,'type' => 'product'], $image_data);
        }

        if($request->category){
            $categories = $request->category;
            DB::table('categories_items')->where('content_id',$productId)->delete();
            foreach($categories as $cat_id){
                DB::table('categories_items')->insert([
                    'category_id' => $cat_id,
                    'content_id' => $productId,
                    'type' => 'product'
                ]);
            }
        }
        return redirect()->route('products.admin');
    }

    public function edit($id){
        $product = DB::table('products')->where('products.id',$id)
                ->leftJoin('images','products.id','images.content_id')
                ->leftJoin('categories_items', 'products.id', 'categories_items.content_id')
                ->leftJoin('categories', 'categories_items.category_id', 'categories.id')
                ->select('products.*', 'images.image', DB::raw("GROUP_CONCAT(categories.id) AS category_ids"))
                ->groupBy('products.id', 'images.image')
                ->first();
        $categories = DB::table('categories')->where('status',1)->where('type',1)->get();

        $product_category_ids = [];
        if(isset($product) and isset($product->category_ids)){
            $category_ids = $product->category_ids;
            $product_category_ids = explode(',', $category_ids);
        }
        return view('/admin/pages/product/add_product')->with(['product' => $product, 'product_category_ids' => $product_category_ids, 'categories' => $categories]);
    }

    public function destroy($id){
        DB::table('products')->where('id', $id)->delete();
        return back();
    }

    public function productSearch(Request $request){
        $data = $request['value'];
        $products = DB::table('products')
                    ->leftJoin('images','products.id','images.content_id')
                    ->where('products.status',1)->where('title', 'like', '%' . $data . '%')
                    ->select('products.*','images.image')->paginate(10);
        if($products){
            $data_html = '';
            foreach ($products as $data){
                $data_html.='<div class="card-body mb-2 product-card">
                                <div class="row">
                                    <div class="product-image col-sm-2 col-md-2 col-lg-2">
                                        <img class="card-img-top" src="'. get_image($data->image,'product').' " alt="">
                                    </div>
                                    <div class="product-info col-sm-8 col-md-8 col-lg-8">
                                        <h4 class="product-title">'. substr($data->title,0,100) . ' </h4>
                                    </div>
                                    <div class="product-action col-sm-2 col-md-2 col-lg-2">
                                        <a href="' . route('product.edit',$data->id) . '" class="btn btn-primary me-2">Edit</a>
                                        <a href="' . route('product.destroy',$data->id) . '" class="btn btn-danger me-2">Delete</a>
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

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home(){
        return view('/frontend/index');
    }

    public function products(){
        $products = DB::table('products')->orderBy('products.created_at')->where('status',1)
                ->leftJoin('images', 'products.id', 'images.content_id')
                ->select('products.title', 'products.price', 'products.url', 'images.image')
                ->paginate(8);
        return view('/frontend/shop')->with('products',$products);
    }

    public function productDetails($url){
        $product = DB::table('products')->where('url',$url)
                ->leftJoin('images', 'products.id', 'images.content_id')
                ->leftJoin('categories_items', 'products.id', 'categories_items.content_id')
                ->leftJoin('categories', 'categories_items.category_id', 'categories.id')
                ->select('products.*', 'images.image', DB::raw("GROUP_CONCAT(categories.name SEPARATOR ', ') AS category_names"))
                ->groupBy('products.id', 'images.image')->first();
        return view('/frontend/product_details')->with('product',$product);
    }

    public function blog(){
        $blogs = DB::table('blogs')
                ->orderBy('created_at')
                ->where('status',1)
                ->where('trash', 0)
                ->leftJoin('users','blogs.auth_id','users.id')
                ->select('blogs.*','users.name')
                ->paginate(6);
        return view('/frontend/blog')->with('blogs',$blogs);
    }

    public function about(){
        return view('/frontend/about');
    }

    public function service(){
        return view('/frontend/service');
    }

    public function contact(){
        return view('/frontend/contact');
    }
}

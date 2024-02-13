<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home(){
        return view('/frontend/index');
    }

    public function shop(){
        return view('/frontend/shop');
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

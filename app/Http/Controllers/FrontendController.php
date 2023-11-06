<?php

namespace App\Http\Controllers;

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
        return view('/frontend/blog');
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

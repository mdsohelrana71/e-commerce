<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        return view('/admin/pages/blogs/index');
    }

    public function blogSettings(){
        return view('/admin/pages/blogs/blog_settings');
    }
}

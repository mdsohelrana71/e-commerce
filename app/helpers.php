<?php
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

function admin_url(){
    return url('/dashboard');
}

function base_url(){
    return url('/');
}

function user_name(){
    $auth = Auth::check();
    if($auth == true){
       return Auth::user()->name;
    }
}

function user_id(){
    $auth = Auth::check();
    if($auth == true){
       return Auth::user()->id;
    }
}

function user_email(){
    $auth = Auth::check();
    if($auth == true){
       return Auth::user()->email;
    }
}

function is_admin(){
    $auth = Auth::check();
    if($auth == true){
        $user_id = Auth::user()->id;
        if($user_id == 1){
            return true;
        }else{
            return false;
        }
    }

}

function get_potion($option_key, $option_group = null) {
    if($option_group == null){
        return DB::table('options')->where('option_key',$option_key)->value('option_value');
    }else{
        return DB::table('options')->where('option_key',$option_key)->where('option_group',$option_group)->value('option_value');
    }
}

function get_image($imageName, $type = null){
    if($type == 'product'){
        $image =  asset('storage/product/images/'.$imageName);
    }elseif($type == 'blog'){
        $image =  asset('storage/blog/images/'.$imageName);
    }elseif($type == 'logo'){
        $image =  asset('admin/images/'.$imageName);
        // if(file_exists($image)){
        //     return $image;
        // }else{
        //     return asset('d-logo.png');
        // }
    }elseif($type == 'user'){
        $image =  asset('admin/images/'.$imageName);
        // if(file_exists($image)){
        //     return $image;
        // }else{
        //     return asset('d-user.png');
        // }
    }
    return $image;
}









?>

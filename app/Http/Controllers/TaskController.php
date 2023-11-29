<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tasks;
class TaskController extends Controller
{
    public function index(){
        return view('/admin/pages/tasks/index');
    }

    public function taskAdd(){
        return view('/admin/pages/tasks/add_task');
    }

    public function taskStore(Request $request){

        DB::table('tasks')->insert([
            'title'      => $request->title,
            'description'=> $request->description,
            'date'       => $request->date
        ]);
        return redirect()->route('tasks');
    }

    public function taskDestroy(Request $request){
        $id = (int)$request->id;
        $type = $request->type;
        if($type == 'tresh'){
            // DB::table('tasks')->where('id',$id)->update([
            //     'tresh' => 1
            // ]);
        }else{
            // DB::table('tasks')->where('id',$id)->delete();
        }
        return response()->json(["data" => [$id,$type]], 200);
    }
}

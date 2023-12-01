<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tasks;
class TaskController extends Controller
{
    public function index(){
        $tasks = DB::table('tasks')
                ->orderBy('created_at')
                ->whereIn('status', [0, 1])
                ->where('trash', 0)
                ->get()
                ->groupBy('status');
        return view('/admin/pages/tasks/index')->with('tasks',$tasks);
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

    public function taskStatusChange(Request $request){
        $id = (int)$request->id;
        $type = (int)$request->type;
        if($type == 0){
            DB::table('tasks')->where('id',$id)->update([
                'status' => 0
            ]);
        }elseif($type == 1){
            DB::table('tasks')->where('id',$id)->update([
                'status' => 1
            ]);
        }elseif($type == 2){
            DB::table('tasks')->where('id',$id)->update([
                'status' => 2
            ]);
        }
        return response()->json(["data" => [$id,$type]], 200);
    }

    public function taskDestroy(Request $request){
        $id = (int)$request->id;
        $type = (int)$request->type;
        if($type == 0){
            DB::table('tasks')->where('id',$id)->update([
                'trash' => 1
            ]);
        }else{
            DB::table('tasks')->where('id',$id)->delete();
        }
        return response()->json(["data" => [$id,$type]], 200);
    }
}

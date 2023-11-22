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
                ->whereIn('status', [1, 2])
                ->where('tresh', 0)
                ->get()
                ->groupBy('status');
        
        return view('/admin/pages/tasks/index')->with('tasks',$tasks);
    }

    public function addTask(){
        return view('/admin/pages/tasks/add_task');
    }

    public function storeTask(Request $request){

        DB::table('tasks')->insert([
            'title'      => $request->title,
            'description'=> $request->description,
            'date'       => $request->date
        ]);
        return view('/admin/pages/tasks/index');
    }
}

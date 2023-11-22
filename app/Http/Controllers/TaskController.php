<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TaskController extends Controller
{
    public function index(){
        $tasks = DB::table('tasks')
            ->whereIn('status',[1,2])->where('tresh',0)
            ->where('tresh', 0)
            ->groupBy('status', 'id')
            ->get();
        dd($tasks);

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

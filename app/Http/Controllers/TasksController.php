<?php

namespace App\Http\Controllers;

use App\Events\TaskCreated;
use App\Events\TaskRemoved;
use App\Tasks;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function fetchAll(){
        $tasks = Tasks::all();
        return $tasks;
    }

    public function store(Request $request){
        $task = Tasks::create($request->all());
        broadcast(new TaskCreated($task));
        return response()->json("Added");
    }

    public function delete($id){
        $task = Tasks::find($id);
        broadcast(new TaskRemoved($task));
        Tasks::destroy($id);
        return response()->json("Deleted");
    }
}

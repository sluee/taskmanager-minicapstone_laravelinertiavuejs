<?php

namespace App\Http\Controllers;

use App\Models\Subtask;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubTaskController extends Controller
{
    public function index()
{
    $subtasks = Subtask::orderBy('name')
        ->with('category')
        ->with('user')
        ->with('tasks') // Eager load the subtasks relationship
        ->get();

    return inertia('subtask/index', compact('subtasks'));
}

public function create(){
    return inertia('task/index');
}

// public function store(Request $request, Task $task){
//     $request->validate([
//             'name'  => 'required|string'
//     ]);
//     // $fields['task_id'] = $task_id;
//     //     $fields['user_id'] = Auth::user()->id;
    
   
//    $subtasks = new Subtask([
//     'name' =>$request->input('name'),
//    ]);

//    $task->subtasks()->save($subtasks);
//     return redirect()->back()->with('message','A new subtask has been added successfully.');
// }

public function store(Request $request, $task_id)
{
    $subtaskData = $request->validate([
        'name' => 'required|string',
    ]);
    
    $subtask = new Subtask();
    $subtask->task_id = $task_id;
    $subtask->name = $subtaskData['name'];
    $subtask->user_id = Auth::user()->id;
    $subtask->save();
    

    // Return a response or redirect as needed
}


public function edit(Subtask $subtask)
{
    
    $user = Auth::user();
    return inertia('task/editSubtask', [
        'subtask'            =>$subtask,
        'tasks'             =>Task::orderBy('status')->get(),
        'users'             =>User::orderBy('name')->get(),
    ]);
}

public function update(Request $request, Subtask $subtask)
{
  
  $fields =  $request->validate([
        'name'       => 'required|string', 
    ]);


// //   $fields =  $subtask->task_id = $task_id;
//     $subtask->name = $request->input('name');
    // Set other subtask fields as needed
    $subtask->update($fields);

    return redirect('/task')->with('message', 'SubTask updated successfully');
}


public function destroy($id)
{
    $subtask = Subtask::findOrFail($id);
    
    $subtask->delete();
    return redirect('/task')->with('message', 'SubTask deleted successfully');
}
}

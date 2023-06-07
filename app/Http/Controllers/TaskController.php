<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subtask;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as HttpRequest;
class TaskController extends Controller
{
    // public function index() {
    //     $task = Task::orderBy('title')
    //     ->with('category')
    //     ->with('user')
    //     ->get();
    //     return inertia('task/index',compact('task'));
    // }

    public function index()
{
    $user = Auth::user();
    $tasksQuery = Task::orderBy('title')
        ->with('category')
        ->with('user')
        ->where('user_id', $user->id)
        ->with('subtasks'); // Eager load the subtasks relationship
        $search = HttpRequest::input('search');

        if($search){
            $tasksQuery->where(function ($query) use ($search){
                $query->where('status', 'like', '%' . $search . '%')
                ->orWhere('title', 'like', '%' . $search . '%');

            });
        }

        $tasks =$tasksQuery->paginate(3)->withQueryString();
        
        $categories = Category::orderBy('category')->get();
        $user = User::orderBy('name')->get();
        $subtasks =Subtask::orderBy('name')->get();
        return inertia('task/index',[
            'tasks' => $tasks,
            'categories'=>$categories,
            'user'      =>$user,
            'subtasks'=>$subtasks,
            'filters'   =>HttpRequest::only(['search'])
        ])->withViewData(['title' =>'Task']);
}


    public function create() {
        $user = Auth::user();
    
    $tasks = Task::orderBy('title')
        ->with('user')
        ->with('category')
        ->with('subtasks') // Eager load the subtasks relationship
        ->get();

    $categories = Category::orderBy('category')->get();
    $users = User::orderBy('name')->get();

    return inertia('task/create', [
        'tasks' => $tasks,
        'categories' => $categories,
        'users' => $users,
    ]);
    }

    public function store(Request $request){
        $request->validate([
            'title'         => 'string|required',
            'description'   => 'string|required',
            'start'         => 'required|date_format:Y-m-d',
            'end'           => 'required|date_format:Y-m-d|after:start',
            'cat_id'        => 'numeric|required',
            'status'        => 'string|required',
        ]);

        Task::create([

            'title' => $request->title,
            'description' => $request->description,
            'start' => $request->start,
            'end' => $request->end,
            'cat_id' => $request->cat_id,
            'user_id'  =>Auth::user()->id,
            'status'    =>$request->status,

        ]);
        return redirect('/task')->with('message','A new task has been added successfully.');
    }

        
    //     $request->validate([
    //     'cat_id'    => 'numeric|required',
    //     'title'       => 'required|string',
    //     'description' => 'required|string',
    //     'status'      => 'required|string',
    //     'start'  => 'required|date',
    //     'end'    => 'required|date|after:start',
    //     'subtasks'    => 'array',  

       
    //     'subtasks.*.name'       => 'required|string',
      
    // ]);

    // $mainTask = Task::create([
    //     'category'    => $request->input('category'),
    //     'title'       => $request->input('title'),
    //     'description' => $request->input('description'),
    //     'status'      => $request->input('status'),
    //     'date_start'  => $request->input('date_start'),
    //     'date_end'    => $request->input('date_end'),
    //     'user_id'  =>Auth::user()->id,
    // ]);

    // Store the subtasks
    // if ($request->has('subtasks')) {
    //     $subtasksData = [];
    //     foreach ($request->input('subtasks') as $subtaskInput) {
    //         $subtaskData = [
    //             'name'      => $subtaskInput['name'],
               
    //         ];
    //         $subtasksData[] = $subtaskData;
    //     }

    //     $mainTask->subtasks()->createMany($subtasksData);
    // }

    //     return redirect('/task')->with('message', 'Task Created Successfully');
    // }

//     public function store(Request $request)
// {
//     $request->validate([
//         'cat_id'      => 'numeric|required',
//         'title'       => 'required|string',
//         'description' => 'required|string',
//         'status'      => 'required|string',
//         'start'       => 'required|date',
//         'end'         => 'required|date|after:start',
//         'subtasks'    => 'array',
//         'subtasks.*.name' => 'required|string',
//     ]);

//     $mainTask = Task::create([
//         'cat_id'      => $request->input('cat_id'),
//         'title'       => $request->input('title'),
//         'description' => $request->input('description'),
//         'status'      => $request->input('status'),
//         'start'       => $request->input('start'),
//         'end'         => $request->input('end'),
//         'user_id'     => Auth::user()->id,
//     ]);

//     // Store the subtasks
//     if ($request->has('subtasks')) {
//         $subtasksData = [];
//         foreach ($request->input('subtasks') as $subtaskInput) {
//             $subtaskData = [
//                 'name'      => $subtaskInput['name'],
//                 'completed' => false, // Set completed to false by default
//             ];
//             $subtasksData[] = $subtaskData;
//         }

//         $mainTask->subtasks()->createMany($subtasksData);
//     }

//     return redirect('/task')->with('message', 'Task created successfully');
// }

// public function store(Request $request)
// {
//     $request->validate([
//         'cat_id'      => 'numeric|required',
//         'title'       => 'required|string',
//         'description' => 'required|string',
//         'status'      => 'required|string',
//         'start'       => 'required|date',
//         'end'         => 'required|date|after:start',
//         'subtasks'    => 'array',
//         'subtasks.*.name' => 'required|string',
//     ]);

//     $mainTask = Task::create([
//         'cat_id'      => $request->input('cat_id'),
//         'title'       => $request->input('title'),
//         'description' => $request->input('description'),
//         'status'      => $request->input('status'),
//         'start'       => $request->input('start'),
//         'end'         => $request->input('end'),
//         'user_id'     => Auth::user()->id,
//     ]);

//     // Store the subtasks
//     if ($request->has('subtasks')) {
//         $subtasksData = [];
//         foreach ($request->input('subtasks') as $subtaskInput) {
//             $subtaskData = [
//                 'name'      => $subtaskInput['name'],
//                 'completed' => false, // Set completed to false by default
//             ];
//             $subtasksData[] = $subtaskData;
//         }

//         $mainTask->subtasks()->createMany($subtasksData);
//     }

//     return redirect('/task')->with('message', 'Task created successfully');
// }


public function edit($id)
{
    $task = Task::findOrFail($id);
    // Additional logic if needed
    $user = Auth::user();
    return inertia('task/edit', [
        'task'          =>$task,
        'categories'    =>Category::orderBy('category')->get(),
        'users'         =>User::orderBy('name')->get(),
    ]);
}

// public function update(Request $request, $id)
// {
//     $request->validate([
//         'cat_id'      => 'numeric|required',
//         'title'       => 'required|string',
//         'description' => 'required|string',
//         'status'      => 'required|string',
//         'start'       => 'required|date',
//         'end'         => 'required|date|after:start',
//         'subtasks'    => 'array',
//         'subtasks.*.name' => 'required|string',
//     ]);

//     $task = Task::findOrFail($id);

//     $task->cat_id = $request->input('cat_id');
//     $task->title = $request->input('title');
//     $task->description = $request->input('description');
//     $task->status = $request->input('status');
//     $task->start = $request->input('start');
//     $task->end = $request->input('end');

//     // Update the main task
//     $task->save();

//     // Update the subtasks
//     if ($request->has('subtasks')) {
//         $subtasksData = [];
//         foreach ($request->input('subtasks') as $subtaskInput) {
//             $subtaskData = [
//                 'name'      => $subtaskInput['name'],
//                 'completed' => false, // Set completed to false by default
//             ];
//             $subtasksData[] = $subtaskData;
//         }

//         $task->subtasks()->delete(); // Delete existing subtasks
//         $task->subtasks()->createMany($subtasksData); // Create new subtasks
//     }

//     return redirect('/task')->with('message', 'Task updated successfully');
// }

public function update(Request $request, $id)
{
    $request->validate([
        'cat_id'      => 'numeric|required',
        'title'       => 'required|string',
        'description' => 'required|string',
        'status'      => 'required|string',
        'start'       => 'required|date',
        'end'         => 'required|date|after:start',
       
    ]);

    $task = Task::findOrFail($id);

    $task->cat_id = $request->input('cat_id');
    $task->title = $request->input('title');
    $task->description = $request->input('description');
    $task->status = $request->input('status');
    $task->start = $request->input('start');
    $task->end = $request->input('end');

    // Update the main task
    $task->save();

    // Update or create the subtasks
    // if ($request->has('subtasks')) {
    //     $subtasksData = [];
    //     foreach ($request->input('subtasks') as $subtaskInput) {
    //         $subtaskData = [
    //             'name'      => $subtaskInput['name'],
    //             'completed' => false, // Set completed to false by default
    //         ];
    //         $subtasksData[] = $subtaskData;
    //     }

    //     $task->subtasks()->delete(); // Delete existing subtasks
    //     if (!empty($subtasksData)) {
    //         $task->subtasks()->createMany($subtasksData); // Create new subtasks
    //     }
    // }

    return redirect('/task')->with('message', 'Task updated successfully');
}

public function destroy($id)
{
    $task = Task::findOrFail($id);

    // Check if the task has any subtasks
    if ($task->subtasks()->count() > 0) {
        // Task has subtasks, handle accordingly (e.g., show an error message, redirect back, etc.)
        return redirect()->back()->withErrors('GeneralErrors', 'Cannot delete task with subtasks');
    }

    // No subtasks, delete the main task
    $task->delete();

    return redirect('/task')->with('message', 'Task deleted successfully');
}


}

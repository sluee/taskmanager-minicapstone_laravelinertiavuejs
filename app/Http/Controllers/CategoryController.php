<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as HttpRequest;
use App\Models\Task;

class CategoryController extends Controller
{

    public function index() {
       
        $user = Auth::user();
        $categoryQuery = Category::orderBy('category')
    ->leftJoin('tasks', 'categories.id', '=', 'tasks.cat_id')
    ->select('categories.*', DB::raw('COUNT(tasks.id) as tasks_count'))
    ->groupBy('categories.id')
    ->with('user')
    ->where('categories.user_id', $user->id);
   
        $search = HttpRequest::input('search');

        if($search){
            $categoryQuery->where(function ($query) use ($search){
                $query->where('category', 'like', '%' . $search . '%');

            });
        }

        $category =$categoryQuery->paginate(3)->withQueryString();
        // $itemCount = Category::leftJoin('tasks', 'categories.id', '=', 'tasks.cat_id')
        // ->select('categories.*', DB::raw('COUNT(tasks.id) as tasks_count'))
        // ->groupBy('categories.id')
        // ->get();

        $user = User::orderBy('name')->get();
        return inertia('category/index',[
            'category' => $category,
            'user'      =>$user,
            // 'itemCount' =>$itemCount,
            'filters'   =>HttpRequest::only(['search'])
        ])->withViewData(['title' =>'Category']);
    }

    public function create(){
        return inertia('category/create');
    }

    public function store(Request $request){
        $request->validate([
            'category'=>'required',
        ]);

        Category::create([
            'category' => $request->category,
            'user_id'  =>Auth::user()->id
        ]);

        return redirect('/category')->with('message','A new category has been added successfully.');
    }

    public function edit(Category $category) {
        return inertia('category/edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request, Category $category) {
        $fields = $request->validate([
            'category'=>'required',
        ]);

        $category->update($fields);

        return redirect('/category')->with('message', 'Category has been updated successfully!');
    }
}

<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SubTaskController;
use App\Http\Controllers\TaskController;
use App\Models\Category;
use App\Models\Subtask;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return inertia('welcome');
});

Route::get('/login', [SiteController::class, 'loginForm'])->name('login');
Route::post('/login',[SiteController::class, 'login']);

Route::get('/register', [SiteController::class, 'registerForm'])->name('register');
Route::post('/register',[SiteController::class, 'register']);

Route::group(['middleware'=>'auth'], function(){

    Route::post('/logout', [SiteController::class, 'logout']);
    Route::get('/dashboard', function(){
        $totalCategory = Category::where('user_id', Auth::user()->id)->count();
        $totalTask = Task::where('user_id', Auth::user()->id)->count();
        $totalSubtask= Subtask::where('user_id', Auth::user()->id)->count();
        return inertia('dashboard',[
            'totalCategory' =>$totalCategory,
            'totalTask' =>$totalTask,
            'totalSubtask'=>$totalSubtask
        ]);
    });

    Route::get('/category',[CategoryController::class ,'index'])->name('category');
    Route::get('/category/create',[CategoryController::class ,'create']);
    Route::post('/category' ,[CategoryController::class ,'store']);
    Route::get('/category/edit/{category}', [CategoryController::class, 'edit']);
    Route::put('/category/{category}', [CategoryController::class, 'update']);


    Route::get('/task',[TaskController::class ,'index'])->name('tasks');
    Route::get('/task/create', [TaskController::class,'create']);
    Route::post('/task' ,[TaskController::class ,'store']);
    Route::get('/task/edit/{id}', [TaskController::class ,'edit']);
    Route::put('/task/{id}', [TaskController::class ,'update']);
    Route::delete('/task/{id}', [TaskController::class ,'destroy']);


    Route::get('/subtask',[SubTaskController::class ,'index']);
    Route::get('/task/index}', [SubTaskController::class,'create']);
    Route::post('/task/{task_id}/subtask' ,[SubTaskController::class ,'store']);
    Route::get('/subtask/edit/{subtask}', [SubTaskController::class ,'edit']);
    Route::put('/subtask/{subtask}', [SubTaskController::class ,'update']);
    Route::delete('/subtask/{id}', [SubTaskController::class ,'destroy']);


});

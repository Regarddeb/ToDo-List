<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\Task\TaskController;
use App\Http\Controllers\List\ListController;
use App\Http\Controllers\Task\FiltersController;
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
    return view('welcome');
});

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(TaskController::class)->middleware('auth')->group(function() {
    Route::get('/task_form', 'task_form')->name('task_form');
    Route::post('/store_task', 'store_task')->name('store_task');
    Route::get('/show_task', 'show_task')->name('show_task');
    Route::post('/update_star', 'update_star')->name('update_star');
    Route::post('/update_done', 'update_done')->name('update_done');
    Route::post('/destroy_task', 'destroy_task')->name('destroy_task');
    Route::post('/get_task', 'get_task')->name('get_task');
    Route::post('/update_task', 'update_task')->name('update_task');
});

Route::controller(ListController::class)->middleware('auth')->group(function() {
    Route::post('/store_list', 'store_list')->name('store_list');
    Route::post('/destroy_list', 'destroy_list')->name('destroy_list');
    Route::get('/show_list', 'show_list')->name('show_list');
    Route::post('/update_list_name', 'update_list_name')->name('update_list_name');
    Route::get('/lists', 'lists')->name('lists');
});

Route::controller(FiltersController::class)->middleware('auth')->group(function(){
    Route::get('/finished_task', 'finished_task')->name('finished_task');
    Route::get('/unfinished_task', 'unfinished_task')->name('unfinished_task');
    Route::post('/main_filter', 'main_filter')->name('main_filter');
    Route::post('/search_task', 'search_task')->name('search_task');
    Route::get('/all_task', 'all_task')->name('all_task');
});
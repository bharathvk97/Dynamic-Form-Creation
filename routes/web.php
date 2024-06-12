<?php

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
    return view('welcome');
});

Route::get('/user_forms', [App\Http\Controllers\UserController::class, 'index'])->name('forms.index');
Route::post('/user_forms/save/{id}', [App\Http\Controllers\UserController::class, 'store'])->name('forms.save');

Auth::routes();

Route::group(['middleware' => ['auth',]], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/list_form', [App\Http\Controllers\AdminController::class, 'list_form'])->name('admin.list.form');
    Route::get('/add_form', [App\Http\Controllers\AdminController::class, 'add_form'])->name('admin.add.form');
    Route::post('/save_form', [App\Http\Controllers\AdminController::class, 'save_form'])->name('admin.form.save');
    Route::get('/edit_form/{id?}', [App\Http\Controllers\AdminController::class, 'edit_form'])->name('admin.form.edit');
    Route::post('/update_form/{id}', [App\Http\Controllers\AdminController::class, 'update_form'])->name('admin.form.update');
    Route::get('/delete_form/{id?}', [App\Http\Controllers\AdminController::class, 'delete_form'])->name('admin.form.delete');
});

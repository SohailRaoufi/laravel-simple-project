<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NewsPostController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//home page route
Route::get('/', function () {
    return view('login.signin');
});

// ------------------------------------------------------ login page routes --------------------------------------------------------
Route::post('login/signin', [UserController::class, 'check']);

// ------------------------------------------------------- Admin Page Routes --------------------------------------------------------

//Code To show admin panel.
Route::get('/user/admin', [NewsPostController::class, 'index'])->middleware('authuser');


//Route::get('/user/admin', [UserController::class, 'view_admin']);
Route::get('user/admin/production', [UserController::class, 'view_admin_production'])->middleware('authuser');
Route::get('user/admin/signout', [UserController::class, 'user_signout'])->middleware('authuser');


//news post routes
Route::get('user/admin/addnewpost', [NewsPostController::class, 'create'])->name('add.post')->middleware('authuser');
Route::post('user/admin/addnewpost', [NewsPostController::class, 'store']);



//Code Used For Editing post.
Route::get('user/admin/posts/{id}/edit', [NewsPostController::class, 'edit'])->name('posts.edit')->middleware('authuser');

//Delete Route
Route::get('user/admin/posts/delete/{id}', function () {
    abort(404, 'Not Found');
});
Route::delete('user/admin/posts/delete/{id}', [NewsPostController::class, 'destroy'])->name('posts.destroy');

//Route For Updating Post.
Route::get('user/admin/posts/update/{id}', function () {
    abort(404, 'Not Found');
});
Route::post('user/admin/posts/update/{id}', [NewsPostController::class, 'update'])->name('posts.update');


//Admins Route for adding new admin and showing all admins and editing and deleting admin.
Route::get('user/admin/admins', [AdminController::class, 'index'])->name('admins.index')->middleware('authuser');
Route::get('user/admin/admins/newadmin', [AdminController::class, 'create'])->name('admins.create')->middleware('authuser');
Route::post('user/admin/admins/newadmin', [AdminController::class, 'store']);
Route::get('user/admin/admins/edit/{id}', [AdminController::class, 'edit'])->name('admins.edit')->middleware('authuser');
Route::post('user/admin/admins/update/{id}', [AdminController::class, 'update'])->name('admins.update');
Route::get('user/admin/admins/update/{id}', function () {
    abort(404, 'Not Found');
});
Route::get('user/admin/admins/delete/{id}', function () {
    abort(404, 'Not Found');
});
Route::delete('user/admin/admins/delete/{id}', [AdminController::class, 'delete'])->name('admins.destroy');



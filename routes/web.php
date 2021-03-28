<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StoreImageController;
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
Route::view('/upload','pages.upload');
Route::post('/uploadPost',[PagesController::class,'imageUploadPost'])->name('upload.post');
// Route::get('/',[PagesController::class,'index']);
Route::get('/',[PagesController::class,'index'])->middleware('auth');
Route::get('/about',[PagesController::class,'about']);
Route::get('/services',[PagesController::class,'services']);


//Auth Routes
Route::view('/login','auth.login')->middleware('guest');
Route::post('/login',[AuthController::class,'login'])->name('login');
Route::view('/register','auth.register')->middleware('guest');
Route::post('/register',[AuthController::class,'register'])->name('register');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');





// Route::get('/create-post', function(){
//     return view('posts.create');
// });

Route::resource('posts',PostsController::class);
// Route::view('/create-post','posts.create');
// Route::post('/createpost',[PostsController::class,'create']);
// Route::get('/posts',[PostsController::class,'list']);
// Route::get('/posts/{id}',[PostsController::class,'show']);
// Route::get('/posts/edit/{id}',[PostsController::class,'edit']);
// Route::put('/posts/edit/{id}',[PostsController::class,'update']);
// Route::delete('/posts/{id}',[PostsController::class,'delete']);


Route::get('store_image', [StoreImageController::class,'index']);
Route::post('store_image/insert_image', [StoreImageController::class,'insert_image']);
Route::get('store_image/fetch_image/{id}', [StoreImageController::class,'fetch_image']);
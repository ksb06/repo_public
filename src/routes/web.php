<?php

use App\Http\Controllers\BlogController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('blog')
->controller(BlogController::class)
->middleware('auth')
->group(function () {
    Route::get('post', 'detail')->name('blog.post');
    Route::get('edit/{blog}', 'detail')->name('blog.edit');
    Route::get('detail/{blog}', 'detail')->name('blog.detail');
    Route::post('register/{blog?}', 'register')->name('blog.register');
    Route::get('delete/{blog}', 'delete')->name('blog.delete');
});

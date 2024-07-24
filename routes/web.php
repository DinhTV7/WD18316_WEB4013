<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admins\SanPhamController;

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

Route::get('/', function () {
    return view('welcome');
});

// Mỗi một route có thể trực tiếp 
// dẫn đến 1 view hoặc 1 hàm trong controller

// Route dẫn đến View
// Route::get('/xinchao', function () {
//     return view('xinchao');
// });

// Route::view('/xinchao', 'xinchao');

// Truyền dữ liệu qua view
// Route::get('/xinchao', function () {
//     $title = "Chào mừng đến với bình nguyên vô tận";
//     $text = "Xin chào nhé!";
//     return view('xinchao', ['title' => $title, 'text' => $text]);
// });

// Route::view('/xinchao', 'xinchao', [
//     'title' => 'Hihi xin chào',
//     'text' => 'Chào bây by'
// ]);

// Route dẫn đến 1 hàm của Controller
Auth::routes();
Route::get('/home', [HomeController::class, 'index']);

// Route resouce
Route::get('sanpham/test', [SanPhamController::class, 'test'])->name('sanpham.test');
Route::resource('sanpham', SanPhamController::class);



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

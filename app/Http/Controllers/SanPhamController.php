<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SanPhamController extends Controller
{
    // Nơi viết các hàm xử lý
    public function index() {
        // dd('Đây là SanPhamController');
        return view('sanpham.index');
    }
}

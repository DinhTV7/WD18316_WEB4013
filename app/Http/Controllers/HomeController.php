<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index () {
        // dd(12345);
        // $title = "Trang chủ";
        // $text = "Đây là trang client";
        // return view('clients.index', [
        //     'title' => $title,
        //     'text' => $text
        // ]);

        $data = [];
        $data['title'] = "Trang chủ";
        $data['text'] = "Đây là trang client 222";
        $data['content'] = "<u>Lớp WD18316</u>";
        $data['dataArr'] = [
            'Item 1',
            'Item 2',
            'Item 3',
        ];
        return view('clients.index', $data);
    }
}

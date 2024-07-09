{{-- extends dùng để kế thừa master layout --}}
@extends('layouts.client')

@section('title')
    {{-- Hiển thị dữ liệu trong blade --}}
    {{ $title }}
@endsection

@section('css')
    {{-- 
        Những thư viện hoặc file CSS dùng riêng cho file được đặt ở đây
    --}}
    <style>
        /* .content {
                background-color: aqua
            } */
    </style>
    <link rel="stylesheet" href="{{ asset('assets/clients/css/index.css') }}">
@endsection

{{-- section: Định nghĩa nội dung của section --}}
@section('content')
    <h1 class="text-danger">{{ $text }}</h1>
    <p>Chào mừng đến với bình nguyên vô tận</p>
    {{-- Phiên dịch mã HTML --}}
    <h1>{!! $content !!}</h1>
    <button onclick="onSubmit()">Submit</button>

    {{-- Các cấu trúc trong Blade view --}}

    {{-- Viết đoạn mã PHP trong blade --}}
    @php
        $flag = true;
    @endphp

    {{-- Vòng lặp for --}}
    @for ($i = 1; $i <= 3; $i++)
        <p>Index: {{ $i }}</p>
    @endfor
    <hr>
    {{-- Vòng lặp foreach --}}
    @foreach ($dataArr as $item)
        <p>Phần tử: {{ $item }}</p>
    @endforeach
    <hr>
    {{-- forelse trong blade --}}
    @forelse ($dataArr as $item)
        <p>Phần tử: {{ $item }}</p>
    @empty
        <p>Không có phần tử nào trong mảng</p>
    @endforelse
    <hr>
    {{-- Cấu trúc rẽ nhánh --}}
    {{-- Câu điều kiện if --}}
    @if ($flag)
        <p>Điều kiện đúng</p>
    @endif

    {{-- Câu điều kiện if-else --}}
    @if ($flag)
        <p>Điều kiện đúng</p>
    @else
        <p>Điều kiện sai</p>
    @endif

    {{-- Câu điều kiện if-elseif --}}
    {{-- @if ($dieu_kien_1)
        Công viêc 1
    @elseif ($dieu_kien_2)
        Công viêc 2
    @elseif ($dieu_kien_3)
        Công viêc 3
    @endif --}}
@endsection

@section('js')
    <script>
        function onSubmit() {
            alert(123456);
        }
    </script>
@endsection

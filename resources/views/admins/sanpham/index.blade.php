{{-- extends dùng để kế thừa master layout --}}
@extends('layouts.admin')

@section('title')
    {{ $title }}
@endsection

@section('css')

@endsection

@section('content')
    <div class="my-5">
        <h4>{{ $title }}</h4>
        <table class="table">
            <thead class="table-dark">
                <th>STT</th>
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Ngày nhập</th>
                <th>Trạng thái</th>
            </thead>
            <tbody>
                @foreach ($listSanPham as $index => $sanPham)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $sanPham->ma_san_pham }}</td>
                    <td>{{ $sanPham->ten_san_pham }}</td>
                    <td>{{ $sanPham->gia }}</td>
                    <td>{{ $sanPham->so_luong }}</td>
                    <td>{{ $sanPham->ngay_nhap }}</td>
                    <td>{{ $sanPham->trang_thai == 1 ? 'Còn hàng' : 'Hết hàng' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('js')

@endsection

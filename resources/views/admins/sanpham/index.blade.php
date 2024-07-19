{{-- extends dùng để kế thừa master layout --}}
@extends('layouts.admin')

@section('title')
    {{ $title }}
@endsection

@section('css')
@endsection

@section('content')
    <div class="my-5">
        {{-- Hiển thị thông báo --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <h4>{{ $title }}</h4>

        <div class="d-flex justify-content-between">
            <a href="{{ route('sanpham.create') }}" class="btn btn-success my-3">Thêm sản phẩm</a>
            <form action="{{ route('sanpham.index') }}" method="GET">
                <div class="input-group">
                    <select name="searchTrangThai" id="" class="form-select">
                        <option value="" selected>Chọn trạng thái</option>
                        <option value="0" {{ request('searchTrangThai') != '0' ? '' : 'selected' }}>Hết hàng</option>
                        <option value="1" {{ request('searchTrangThai') != '1' ? '' : 'selected' }}>Còn hàng</option>
                    </select>
                    <input type="text" class="form-control" name="search" placeholder="Tìm kiếm" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-secondary">Tìm kiếm</button>
                </div>
            </form>
        </div>
        <table class="table">
            <thead class="table-dark">
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Ngày nhập</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </thead>
            <tbody>
                @foreach ($listSanPham as $index => $sanPham)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <img src="{{ Storage::url($sanPham->hinh_anh) }}" width="150px" alt="Hình ảnh sản phẩm">
                        </td>
                        <td>{{ $sanPham->ma_san_pham }}</td>
                        <td>{{ $sanPham->ten_san_pham }}</td>
                        <td>{{ $sanPham->gia }}</td>
                        <td>{{ $sanPham->so_luong }}</td>
                        <td>{{ $sanPham->ngay_nhap }}</td>
                        <td>{{ $sanPham->trang_thai == 1 ? 'Còn hàng' : 'Hết hàng' }}</td>
                        <td>
                            <a href="{{ route('sanpham.edit', $sanPham->id) }}" class="btn btn-warning">Sửa</a>
                            <form action="{{ route('sanpham.destroy', $sanPham->id) }}" class="d-inline" method="POST"
                                onsubmit="return confirm('Bạn có đồng ý xóa hay không?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{-- Hiển thị phân trang --}}
            {{ $listSanPham->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection

@section('js')
@endsection

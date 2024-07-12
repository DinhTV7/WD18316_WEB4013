{{-- extends dùng để kế thừa master layout --}}
@extends('layouts.admin')

@section('title')
    {{ $title }}
@endsection

@section('css')
@endsection

@section('content')
    <div class="card my-5">
        <h4 class="card-header">{{ $title }}</h4>
        <div class="card-body">
            <form action="{{ route('sanpham.store') }}" method="POST">
                {{-- Làm việc với Form trong Laravel --}}
                {{-- 
                    CSRF Field: Là một trường ẩn mà Laravel bắt buộc nhúng vào form
                                cho mục đích bảo mật, bảo vệ website
                --}}
                @csrf

                <div class="mb-3">
                    <label class="form-label">Mã sản phẩm:</label>
                    <input type="text" class="form-control" name="ma_san_pham" placeholder="Nhập mã sản phẩm">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tên sản phẩm:</label>
                    <input type="text" class="form-control" name="ten_san_pham" placeholder="Nhập tên sản phẩm">
                </div>

                <div class="mb-3">
                    <label class="form-label">Giá sản phẩm:</label>
                    <input type="number" class="form-control" name="gia" min="1" placeholder="Nhập giá">
                </div>

                <div class="mb-3">
                    <label class="form-label">Số lượng:</label>
                    <input type="number" class="form-control" name="so_luong" min="1" placeholder="Nhập số lượng">
                </div>

                <div class="mb-3">
                    <label class="form-label">Ngày nhập:</label>
                    <input type="date" class="form-control" name="ngay_nhap">
                </div>
                <div class="mb-3">
                    <label class="form-label">Trạng thái:</label>
                    <select class="form-select" name="trang_thai">
                        <option selected>Trạng thái</option>
                        <option value="1">Còn hàng</option>
                        <option value="0">Hết hàng</option>
                    </select>
                </div>
                <div class="mb-3 d-flex justify-content-center">
                    <button type="reset" class="btn btn-outline-secondary me-3">Nhập lại</button>
                    <button type="submit" class="btn btn-success">Thêm mới</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
@endsection

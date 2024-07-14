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
            <form action="{{ route('sanpham.store') }}" method="POST" enctype="multipart/form-data">
                {{-- Làm việc với Form trong Laravel --}}
                {{-- 
                    CSRF Field: Là một trường ẩn mà Laravel bắt buộc nhúng vào form
                                cho mục đích bảo mật, bảo vệ website
                --}}
                @csrf

                <div class="mb-3">
                    <label class="form-label">Mã sản phẩm:</label>
                    {{-- {{ old('ma_san_pham') }} giữ lại giá trị nhập vào sau khi có lỗi --}}
                    <input type="text" class="form-control" name="ma_san_pham" value="{{ old('ma_san_pham') }}" placeholder="Nhập mã sản phẩm">

                    {{-- Hiển thị lỗi --}}
                    @error('ma_san_pham')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Tên sản phẩm:</label>
                    <input type="text" class="form-control" name="ten_san_pham" value="{{ old('ten_san_pham') }}"placeholder="Nhập tên sản phẩm">
                    @error('ten_san_pham')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Giá sản phẩm:</label>
                    <input type="number" class="form-control" name="gia" value="{{ old('gia') }}" placeholder="Nhập giá">
                    @error('gia')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Số lượng:</label>
                    <input type="number" class="form-control" name="so_luong" value="{{ old('so_luong') }}" placeholder="Nhập số lượng">
                    @error('so_luong')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Ngày nhập:</label>
                    <input type="date" class="form-control" value="{{ old('ngay_nhap') }}" name="ngay_nhap">
                    @error('ngay_nhap')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Trạng thái:</label>
                    <select class="form-select" name="trang_thai">
                        <option value="" selected>Trạng thái</option>
                        <option value="1">Còn hàng</option>
                        <option value="0">Hết hàng</option>
                    </select>
                    @error('trang_thai')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Hình ảnh:</label>
                    <input type="file" class="form-control" name="hinh_anh" id="image" accept="image/*"
                        onchange="previewImage(event)">
                </div>
                <img id="image_preview" src="" alt="Hình ánh ản phẩm"
                    style="max-width: 200px; max-height: 100px; display: none;">

                <div class="mb-3 d-flex justify-content-center">
                    <button type="reset" class="btn btn-outline-secondary me-3">Nhập lại</button>
                    <button type="submit" class="btn btn-success">Thêm mới</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function previewImage(event) {
            const imagePreview = document.getElementById('image_preview');
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function() {
                imagePreview.src = reader.result;
                imagePreview.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection

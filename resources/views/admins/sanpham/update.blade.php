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
            <form action="{{ route('sanpham.update', $sanPham->id ) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Mã sản phẩm:</label>
                    <input type="text" class="form-control" name="ma_san_pham" value="{{ $sanPham->ma_san_pham }}" placeholder="Nhập mã sản phẩm">
                    @error('ma_san_pham')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Tên sản phẩm:</label>
                    <input type="text" class="form-control" name="ten_san_pham" value="{{ $sanPham->ten_san_pham }}" placeholder="Nhập tên sản phẩm">
                </div>

                <div class="mb-3">
                    <label class="form-label">Giá sản phẩm:</label>
                    <input type="number" class="form-control" name="gia" min="1" value="{{ $sanPham->gia }}" placeholder="Nhập giá">
                </div>

                <div class="mb-3">
                    <label class="form-label">Số lượng:</label>
                    <input type="number" class="form-control" name="so_luong" min="1" value="{{ $sanPham->so_luong }}" placeholder="Nhập số lượng">
                </div>

                <div class="mb-3">
                    <label class="form-label">Ngày nhập:</label>
                    <input type="date" class="form-control" name="ngay_nhap" value="{{ $sanPham->ngay_nhap }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Trạng thái:</label>
                    <select class="form-select" name="trang_thai">
                        <option selected>Trạng thái</option>
                        <option value="1" {{ $sanPham->trang_thai == 1 ? 'selected' : '' }}>Còn hàng</option>
                        <option value="0" {{ $sanPham->trang_thai == 0 ? 'selected' : '' }}>Hết hàng</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Hình ảnh:</label>
                    <input type="file" class="form-control" name="hinh_anh" id="image" accept="image/*"
                        onchange="previewImage(event)">
                </div>
                <img id="image_preview"
                    src="{{ Storage::url($sanPham->hinh_anh) }}"
                    alt="Hình ánh ản phẩm" style="max-width: 200px; max-height: 100px;">

                <div class="mb-3 d-flex justify-content-center">
                    <button type="reset" class="btn btn-outline-secondary me-3">Nhập lại</button>
                    <button type="submit" class="btn btn-warning">Chỉnh sửa</button>
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

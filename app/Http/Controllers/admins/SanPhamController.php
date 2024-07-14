<?php

namespace App\Http\Controllers\admins;

use App\Models\SanPham;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SanPhamRequest;
use Illuminate\Support\Facades\Storage;

class SanPhamController extends Controller
{
    // Sử dụng khi dùng SQL thuần và Query Builder
    public $san_pham;
    // Khởi tạo 1 đối tượng là sản phẩm model
    public function __construct()
    {
        $this->san_pham = new SanPham();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Sử dụng khi dùng SQL thuần và Query Builder
        // Lấy ra dữ liệu
        // $listSanPham = $this->san_pham->getList();

        // Sử dụng Eloquent
        $listSanPham = SanPham::orderByDesc('id')->get();

        // toArray: Để lấy ra mảng dữ liệu
        $title = "Danh sách sản phẩm";
        return view('admins.sanpham.index', compact('title', 'listSanPham'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Thêm sản phẩm";
        return view('admins.sanpham.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SanPhamRequest $request)
    {
        // Kiểm tra người có sử dụng FORM để gửi dữ liệu lên không
        if ($request->isMethod('POST')) {
            // Validate 
            // Cách 1: Viết trực tiếp trong controller
            // $validated = $request->validate(
            //     [
            //         'ma_san_pham' => 'required|unique:san_phams|max:10',
            //         'ten_san_pham' => 'required|max:100',
            //         'gia' => 'required|numeric|min:1|max:999999',
            //         'so_luong' => 'required|integer|min:1',
            //         'ngay_nhap' => 'required|date',
            //         'trang_thai' => 'required|in:1,0',
            //     ],
            //     [
            //         'ma_san_pham.required' => 'Mã sản phẩm bắt buộc điền.',
            //         'ma_san_pham.unique' => 'Mã sản phẩm đã tồn tại.',
            //         'ma_san_pham.max' => 'Mã sản phẩm không được vượt quá 10 ký tự.',
            //         'ten_san_pham.required' => 'Tên sản phẩm bắt buộc điền.',
            //         'ten_san_pham.max' => 'Tên sản phẩm không được vượt quá 100 ký tự.',
            //         'gia.required' => 'Giá bắt buộc điền.',
            //         'gia.numeric' => 'Giá phải là một số.',
            //         'gia.min' => 'Giá phải lớn hơn hoặc bằng 1.',
            //         'gia.max' => 'Giá không được vượt quá 999,999đ.',
            //         'so_luong.required' => 'Số lượng bắt buộc điền.',
            //         'so_luong.integer' => 'Số lượng phải là một số nguyên.',
            //         'so_luong.min' => 'Số lượng phải lớn hơn hoặc bằng 1.',
            //         'ngay_nhap.required' => 'Ngày nhập bắt buộc điền.',
            //         'ngay_nhap.date' => 'Ngày nhập phải là một ngày hợp lệ.',
            //         'trang_thai.required' => 'Trạng thái bắt buộc điền.',
            //         'trang_thai.in' => 'Nhập lại trạng thái.',
            //     ]
            // );

            // Cách 2: Tách validate ra 1 file
            // Thay thế class Request bằng class request bạn muốn dùng
            // Khi dùng validated(), Laravel đã tự động loại bỏ các trường không cần thiết như _token
            $params = $request->validated();

            // CSRF Feild: Sẽ tự động sinh ra 1 _token cho mỗi phiên người dùng
            // Trước khi thêm dữ liệu ta cần phải loại bỏ nó ra khỏi $params
            // Cách 1:
            // $params = $request->post();
            // unset($params['_token']);

            // Cách 2:
            // $params = $request->except('_token');

            // Xử lý ảnh
            if ($request->hasFile('hinh_anh')) {
                // Nếu có đẩy hình ảnh
                $filename = $request->file('hinh_anh')->store('uploads/sanpham', 'public');
            } else {
                $filename = null;
            }

            $params['hinh_anh'] = $filename;

            // Sử dụng Query Builder
            // $this->san_pham->createProduct($params);

            // Sử dụng Eloquent
            SanPham::create($params);

            // Sau khi thêm thành công thì quay trở về trang danh sách
            // Bắn kèm theo 1 thông báo
            return redirect()->route('sanpham.index')->with('success', 'Thêm sản phẩm thành công!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Sử dụng Query Builder
        $sanPham = $this->san_pham->getDetailProduct($id);

        if (!$sanPham) {
            return redirect()->route('sanpham.index')->with('error', 'Không tìm thấy sản phẩm!');
        }

        $title = "Chỉnh sửa thông tin sản phẩm";

        return view('admins.sanpham.update', compact('title', 'sanPham'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SanPhamRequest $request, string $id)
    {
        // dd($request->all());
        // Sử dụng Query Builder
        // $sanPham = $this->san_pham->getDetailProduct($id);

        // Sử dụng Eloquent
        $sanPham = SanPham::findOrFail($id);

        $params = $request->except('_token', '_method');

        // Xử lý ảnh
        if ($request->hasFile('hinh_anh')) {
            if ($sanPham->hinh_anh) {
                // Nếu upload hình ảnh mới thì xóa ảnh cũ
                Storage::disk('public')->delete($sanPham->hinh_anh);
            }

            // Thêm ảnh mới
            $filename = $request->file('hinh_anh')->store('uploads/sanpham', 'public');
            $params['hinh_anh'] = $filename;
        } else {
            // Nếu ko upload ảnh mới thì vẫn giữ ảnh cũ
            $params['hinh_anh'] = $sanPham->hinh_anh;
        }

        // dd($params);

        // Sử dụng Query Builder
        // $this->san_pham->updateProduct($id, $params);

        // Sử dụng Eloquent
        $sanPham->update($params);

        return redirect()->route('sanpham.index')->with('success', 'Sản phẩm đã được cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Sử dụng Eloquent
        // Lấy ra sản phẩm theo ID
        $sanPham = SanPham::findOrFail($id);

        // dd($san_pham);

        if ($sanPham) {
            // Nếu tìm thấy sản phẩm thì mới tiến hành xóa sản phẩm đó đi
            $sanPham->delete();
            // Xóa hình ảnh của sản phẩm
            if ($sanPham->hinh_anh) {
                Storage::disk('public')->delete($sanPham->hinh_anh);
            }
            return redirect()->route('sanpham.index')->with('success', 'Xóa sản phẩm thành công!');
        }

        // Khôi phục một dòng dữ liệu đã soft delete
        // $sanPham->restore();

        // Xóa vĩnh viễn một dòng dữ liệu đã soft delete
        // $sanPham->forceDelete();

        return redirect()->route('sanpham.index')->with('error', 'Không tìm thấy sản phẩm!');
    }


    public function test()
    {
        dd('Phương thức test');
    }
}

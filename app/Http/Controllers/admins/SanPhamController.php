<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\SanPham;
use Illuminate\Http\Request;

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
        $listSanPham = SanPham::get();
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
    public function store(Request $request)
    {
        // Kiểm tra người có sử dụng FORM để gửi dữ liệu lên không
        if ($request->isMethod('POST')) {
            // Kiểm tra dữ liệu gửi lên
            // $params = $request->post();
            // dd($params);

            // CSRF Feild: Sẽ tự động sinh ra 1 _token cho mỗi phiên người dùng
            // Trước khi thêm dữ liệu ta cần phải loại bỏ nó ra khỏi $params
            // Cách 1:
            // $params = $request->post();
            // unset($params['_token']);

            // Cách 2:
            $params = $request->except('_token');

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Sử dụng Eloquent
        // Lấy ra sản phẩm theo ID
        $san_pham = SanPham::findOrFail($id);

        // dd($san_pham);

        if ($san_pham) {
            // Nếu tìm thấy sản phẩm thì mới tiến hành xóa sản phẩm đó đi
            $san_pham->delete();
            return redirect()->route('sanpham.index')->with('success', 'Xóa sản phẩm thành công!');
        }
    }


    public function test()
    {
        dd('Phương thức test');
    }
}

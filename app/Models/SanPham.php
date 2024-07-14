<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SanPham extends Model
{
    use HasFactory;

    // Cách 1: Viết truy vấn SQL thuần (Raw Query)
    // public function getList() {
    //     $listSanPham = DB::select('SELECT * FROM san_phams ORDER BY id DESC');

    //     return $listSanPham;
    // }

    // Cách 2: Sử dụng Query Builder
    public function getList()
    {
        $listSanPham = DB::table('san_phams')
            ->orderBy('id', 'DESC')
            ->get();

        return $listSanPham;
    }

    // Thêm sản phẩm bằng Query Builder
    public function createProduct($data)
    {
        DB::table('san_phams')->insert($data);
    }

    // Thông tin chi tiết
    public function getDetailProduct($id)
    {
        $sanPham = DB::table('san_phams')
            ->where('id', $id)
            ->first();

        return $sanPham;
    }

    // Chỉnh sửa
    public function updateProduct($id, $data)
    {
        DB::table('san_phams')
            ->where('id', $id)
            ->update($data);
    }

    // Xóa sản phẩm bằng Query Builder
    public function dateleProduct($id)
    {
        DB::table('san_phams')
            ->where('id', $id)
            ->delete();
    }


    // Cách 3: Sử dụng Eloquent
    protected $table = 'san_phams';

    protected $fillable = [
        'ma_san_pham',
        'hinh_anh',
        'ten_san_pham',
        'gia',
        'so_luong',
        'ngay_nhap',
        'trang_thai',
    ];

    // Sử dụng khi muốn xóa mềm
    use SoftDeletes;

    // Khi sử dụng SoftDeletes và hiển thị danh sách bằng Eloquent thì dữ liệu xóa bằng SoftDeletes sẽ tự ẩn
    // Còn nếu bạn sử dựng Query builer để hiển thị danh sách thì cần phải sửa lại câu truy vấn như sau:
    // DB::table('san_phams')
    //         ->whereNull('deleted_at')
    //         ->orderBy('id', 'DESC')
    //         ->update($data);


    // public $timestamps = false;
}

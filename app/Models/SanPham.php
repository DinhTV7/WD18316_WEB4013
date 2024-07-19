<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    // Lấy thông tin chi tiết
    public function getDetailProduct($id)
    {
        $sanPham = DB::table('san_phams')
            ->where('id', $id)
            ->where('deleted_at', null)
            ->first();

        return $sanPham;
    }

    // Cập nhật dữ liệu
    public function updateProduct($id, $data)
    {
        DB::table('san_phams')
            ->where('id', $id)
            ->update($data);
    }

    // Xóa sản phẩm bằng Query Builder
    public function deleteProduct($id)
    {
        DB::table('san_phams')
            ->where('id', $id)
            ->delete();
    }


    // Cách 3: Sử dụng Eloquent
    use SoftDeletes;

    protected $table = 'san_phams';

    protected $fillable = [
        'hinh_anh',
        'ma_san_pham',
        'ten_san_pham',
        'gia',
        'so_luong',
        'ngay_nhap',
        'trang_thai',
        'deleted_at'
    ];

    public $timestamps = false;
}

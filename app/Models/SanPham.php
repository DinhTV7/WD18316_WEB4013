<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
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
    public function getList() {
        $listSanPham = DB::table('san_phams')
                    ->orderBy('id', 'DESC')
                    ->get();

        return $listSanPham;
    }

    // Thêm sản phẩm bằng Query Builder
    public function createProduct($data) {
        DB::table('san_phams')->insert($data);
    }

    // Xóa sản phẩm bằng Query Builder
    

    // Cách 3: Sử dụng Eloquent
    protected $table = 'san_phams';

    protected $fillable = [
        'ma_san_pham',
        'ten_san_pham',
        'gia',
        'so_luong',
        'ngay_nhap',
        'trang_thai',
    ];

    public $timestamps = false;
}

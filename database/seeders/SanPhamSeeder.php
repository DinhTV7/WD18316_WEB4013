<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SanPhamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Thêm dữ liệu mẫu
        // DB::table('ten_bảng')->Các phương thức();

        // Tìm hiểu thêm faker trong laravel

        DB::table('san_phams')->insert(
            [
                [
                    'ma_san_pham' => 'SP0001',
                    'ten_san_pham' => 'Iphone 16',
                    'gia' => 100000,
                    'so_luong' => 10,
                    'ngay_nhap' => Carbon::now(),
                    'trang_thai' => true
                ],
                [
                    'ma_san_pham' => 'SP0002',
                    'ten_san_pham' => 'Iphone 17',
                    'gia' => 200000,
                    'so_luong' => 20,
                    'ngay_nhap' => Carbon::now(),
                    'trang_thai' => true
                ]
            ]
        );
    }
}

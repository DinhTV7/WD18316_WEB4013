<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('san_phams', function (Blueprint $table) {
            $table->string('hinh_anh')->nullable()->after('ma_san_pham'); // Thêm trường hình ảnh, sau trường ma_san_pham
            $table->double('gia', 10, 2)->change(); // Sửa trường giá từ (8, 2) thành (10, 2)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Luôn luôn phải có hàm DOWN là những cuông việc ngược lại hàm UP
        Schema::table('san_phams', function (Blueprint $table) {
            $table->dropColumn('hinh_anh'); // Xóa trường hình ảnh
            $table->double('gia', 8, 2)->change(); // Sửa lại trường giá về (8, 2)
        });
    }
};

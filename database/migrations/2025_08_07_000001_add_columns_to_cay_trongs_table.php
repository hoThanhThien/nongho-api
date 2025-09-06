<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Kiểm tra xem cột đã tồn tại chưa trước khi thêm
        $columns = DB::select("SHOW COLUMNS FROM cay_trongs LIKE 'loai_cay'");
        
        if (empty($columns)) {
            DB::statement("ALTER TABLE cay_trongs 
                ADD COLUMN loai_cay VARCHAR(100) DEFAULT 'khác' AFTER ten_cay,
                ADD COLUMN dien_tich DECIMAL(10,2) DEFAULT 0 AFTER giong,
                ADD COLUMN ngay_trong DATE NULL AFTER dien_tich,
                ADD COLUMN trang_thai ENUM('đang_phát_triển', 'thu_hoạch', 'hoàn_thành') DEFAULT 'đang_phát_triển' AFTER ngay_trong,
                ADD COLUMN ghi_chu TEXT NULL AFTER trang_thai
            ");
        }

        // Đổi tên cột thuadat_id thành thua_dat_id nếu cần
        $thuadatColumn = DB::select("SHOW COLUMNS FROM cay_trongs LIKE 'thuadat_id'");
        if (!empty($thuadatColumn)) {
            DB::statement("ALTER TABLE cay_trongs CHANGE thuadat_id thua_dat_id BIGINT UNSIGNED");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE cay_trongs 
            DROP COLUMN IF EXISTS loai_cay,
            DROP COLUMN IF EXISTS dien_tich,
            DROP COLUMN IF EXISTS ngay_trong,
            DROP COLUMN IF EXISTS trang_thai,
            DROP COLUMN IF EXISTS ghi_chu
        ");
        
        // Đổi lại tên cột nếu cần
        DB::statement("ALTER TABLE cay_trongs CHANGE thua_dat_id thuadat_id BIGINT UNSIGNED");
    }
};

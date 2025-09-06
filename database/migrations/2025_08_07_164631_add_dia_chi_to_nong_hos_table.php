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
        // Kiểm tra xem cột đã tồn tại chưa
        $columns = DB::select("SHOW COLUMNS FROM nong_hos LIKE 'dia_chi'");
        
        if (empty($columns)) {
            DB::statement("ALTER TABLE nong_hos 
                ADD COLUMN dia_chi VARCHAR(500) NULL AFTER ten,
                ADD COLUMN so_dien_thoai VARCHAR(15) NULL AFTER dia_chi,
                ADD COLUMN email VARCHAR(255) NULL AFTER so_dien_thoai
            ");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE nong_hos 
            DROP COLUMN IF EXISTS dia_chi,
            DROP COLUMN IF EXISTS so_dien_thoai,
            DROP COLUMN IF EXISTS email
        ");
    }
};

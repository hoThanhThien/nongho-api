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
        // Kiểm tra xem cột email đã tồn tại chưa
        $columns = DB::select("SHOW COLUMNS FROM nong_hos LIKE 'email'");
        
        if (empty($columns)) {
            DB::statement("ALTER TABLE nong_hos ADD COLUMN email VARCHAR(255) NULL");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE nong_hos DROP COLUMN IF EXISTS email");
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
{
    Schema::create('cay_trongs', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('thua_dat_id');
        $table->string('ten_cay');
        $table->string('loai_cay')->default('khác');
        $table->string('giong')->nullable();
        $table->decimal('dien_tich', 10, 2)->default(0);
        $table->date('ngay_trong')->nullable();
        $table->enum('trang_thai', ['đang_phát_triển', 'thu_hoạch', 'hoàn_thành'])->default('đang_phát_triển');
        $table->text('ghi_chu')->nullable();
        $table->timestamps();

        $table->foreign('thua_dat_id')->references('id')->on('thuadats')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cay_trongs');
    }
};

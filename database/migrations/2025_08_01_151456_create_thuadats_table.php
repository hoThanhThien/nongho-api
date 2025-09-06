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
       Schema::create('thuadats', function (Blueprint $table) {
           $table->id();
           $table->unsignedBigInteger('nongho_id');
           $table->string('ten_thua');
           $table->float('dien_tich');
           $table->timestamps();

           $table->foreign('nongho_id')->references('id')->on('nong_hos')->onDelete('cascade');
       });
   }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thua_dats');
    }
};

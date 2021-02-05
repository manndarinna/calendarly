<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrivatanCasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('privatan_cas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('zakazao_id');
            $table->foreign('zakazao_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('rezervisao_id');
            $table->foreign('rezervisao_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->date('datum');
            $table->integer('trajanje');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('privatan_cas');
    }
}

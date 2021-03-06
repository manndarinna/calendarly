<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKonsultacijasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konsultacija', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('naziv');
            $table->string('opis');
            $table->dateTime('datum');
            $table->integer('max_prijava');
            $table->integer('broj_prijava')->default(0);
            $table->unsignedBigInteger('zakazao_id');
            $table->foreign('zakazao_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konsultacijas');
    }
}

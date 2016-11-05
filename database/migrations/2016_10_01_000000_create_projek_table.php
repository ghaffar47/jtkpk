<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjekTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projek', function (Blueprint $table)
        {
            $table->engine = 'InnoDB';            
            $table->increments('id');
            $table->integer('devteam_id')->unsigned();
            $table->string('nama_projek')->unique();
            $table->text('objektif')->nullable();
            $table->text('detail')->nullable();
            $table->string('kertas_kerja')->nullable();
            $table->string('repositori')->nullable();
            $table->timestamps();
            $table->foreign('devteam_id')->references('id')->on('devteam')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('projek');
    }
}

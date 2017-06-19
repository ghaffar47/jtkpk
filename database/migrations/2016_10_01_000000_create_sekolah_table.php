<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSekolahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sekolah', function (Blueprint $table)
        {
            $table->engine = 'InnoDB';            
            $table->increments('id');
            $table->string('kod_ppd');
            $table->string('kod_sekolah')->unique();
            $table->string('nama_sekolah');
            $table->string('alamat')->nullable();
            $table->integer('poskod')->nullable();
            $table->string('bandar')->nullable();
            $table->string('no_telefon')->nullable();
            $table->string('no_fax')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('nama_kj')->nullable();
            $table->string('jawatan_kj')->nullable();
            $table->string('emel_kj')->nullable();
            $table->string('pwd_1bestarinet')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->foreign('kod_ppd')->references('kod_ppd')->on('ppd')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sekolah');
    }
}

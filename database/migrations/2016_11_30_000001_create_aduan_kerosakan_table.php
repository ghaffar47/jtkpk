<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAduanKerosakanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aduan_kerosakan', function (Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable()->default(0);
            $table->string('kod_ppd')->nullable();
            $table->string('kod_jpn')->nullable();
            $table->integer('no_siri_aduan')->nullable()->default(0);
            $table->date('tarikh_aduan');
            $table->string('nama')->nullable();
            $table->string('email')->nullable();
            $table->string('jawatan')->nullable();
            $table->string('no_telefon')->nullable();
            $table->string('lokasi_peralatan')->nullable();
            $table->string('no_dhm')->nullable();
            $table->text('kategori_kerosakan')->nullable();
            $table->string('kategori_aduan')->nullable();
            $table->text('keterangan_kerosakan')->nullable();
            $table->text('laporan_tindakan')->nullable();
            $table->date('tarikh_pemeriksaan')->nullable();
            $table->string('status_aduan')->nullable();
            $table->string('status_peralatan')->nullable();
            $table->date('tarikh_selesai')->nullable();
            $table->string('hakmilik_peralatan')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('aduan_kerosakan');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmartteamAktivitiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aktiviti_smartteam', function (Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('smart_team_id')->unsigned();
            $table->string('nama_aktiviti')->unique();
            $table->string('tempat')->nullable();
            $table->date('tarikh_dari')->nullable();
            $table->date('tarikh_hingga')->nullable();
            $table->string('jtk_terlibat')->nullable();
            $table->text('objektif')->nullable();
            $table->text('detail')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->foreign('smart_team_id')->references('id')->on('smartteam')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('aktiviti_smartteam');
    }
}

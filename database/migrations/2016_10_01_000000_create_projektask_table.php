<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjektaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projek_task', function (Blueprint $table)
        {
            $table->engine = 'InnoDB';            
            $table->increments('id');
            $table->integer('projek_id')->unsigned();
            $table->string('tajuk_task')->unique();
            $table->text('detail_task')->nullable();
            $table->string('assigned')->nullable();
            $table->integer('peratus_siap')->nullable()->default(0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->foreign('projek_id')->references('id')->on('projek')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('projek_task');
    }
}

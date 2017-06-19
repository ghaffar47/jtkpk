<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjektaskdetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projek_task_detail', function (Blueprint $table)
        {
            $table->engine = 'InnoDB';          
            $table->increments('id');
            $table->integer('task_id')->unsigned();
            $table->integer('timeline_by')->nullable()->default(0);
            $table->text('detail')->nullable();
            $table->string('progress_type')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->foreign('task_id')->references('id')->on('projek_task')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('projek_task_detail');
    }
}

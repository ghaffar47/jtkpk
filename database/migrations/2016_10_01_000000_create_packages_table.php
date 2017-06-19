<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table)
        {
            $table->engine = 'InnoDB';            
            $table->increments('id');
            $table->string('package_name')->unique();
            $table->string('package_title');
            $table->text('package_description')->nullable();
            $table->string('package_author')->nullable();
            $table->string('package_icon')->nullable();
            $table->string('package_icon_text')->nullable();
            $table->string('package_url')->nullable();
            $table->integer('package_status')->default(0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('packages');
    }
}

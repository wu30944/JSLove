<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title','50')->index()->nullable()->comment('標題');
            $table->string('content')->nullable()->comment('內容');
            $table->boolean('is_show')->default(1)->comment('是否顯示 1.顯示 0.隱藏');
            $table->time('show_date')->comment('顯示日期');
            $table->string('create_user','20')->nullable()->comment('建立者');
            $table->string('modify_user','20')->nullable()->comment('修改者');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gallery');
    }
}

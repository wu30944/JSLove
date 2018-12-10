<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarouselTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carousel', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->index()->nullable()->comment('圖片標題');
            $table->text('description')->nullable()->comment('圖片描述');
            $table->string("photo_url")->comment('圖片URL');
            $table->tinyInteger('is_show')->default(1)->unsigned()->index()->comment('是否顯示: 1 是 , 0 否');
            $table->dateTime("show_date")->nullable()->comment("要顯示的日期");
            $table->string("button_title")->nullable()->comment('圖片上方按鈕文字');
            $table->string("button_url")->nullable()->comment('圖片上方按鈕連結');
            $table->integer('sort')->default(255)->unsigned()->comment('排序');
            $table->string('created_user',50);
            $table->string('modify_user',50);
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
        Schema::dropIfExists('carousel');
    }
}

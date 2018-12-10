<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_files', function (Blueprint $table) {
            $table->increments('id');
            $table->text("file_url")->comment("檔案位置");
            $table->string("remark",100)->nullable()->comment("備註");
            $table->integer('news_id')->unsigned()->comment("對應news中的id");
            $table->foreign('news_id')->references('id')->on('news');
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
        Schema::dropIfExists('news_files');
    }
}

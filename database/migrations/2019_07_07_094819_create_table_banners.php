<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBanners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            //创建表 user是你的表名
            Schema::create('banners', function (Blueprint $table) {
            //increments string timestamps 类型
            $table->increments('id');
            $table->string('title');
            $table->integer('status');
            $table->string('url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //删除表
        Schema::drop('banners');
    }
}

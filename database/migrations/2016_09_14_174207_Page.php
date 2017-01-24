<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Page extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            $table->string('title');
            $table->longText('content_tab');
            $table->longText('content_mobile');
            $table->longText('content');

            $table->string('description');
            $table->string('tags');

            $table->tinyInteger('menu')->default(1);


            $table->integer('category_id')->default(-1);



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
        Schema::drop('pages');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Post extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
        $table->id();
        $table->bigInteger('category_id')->unsigned();
        $table->string('author');
        $table->string('title');
        $table->mediumText('short_desc');
        $table->longText('content');
        $table->boolean('status');
        $table->bigInteger('views');
        $table->string('image');
        $table->timestamps();
        $table->foreign('category_id')->references('id')->on('categories_posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

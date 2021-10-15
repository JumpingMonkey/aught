<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainPageModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_page_models', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->json('hero_slider_articles');
            $table->json('hero_btn_title');
            $table->json('display_articles_2_block');
            $table->json('article_for_3_block');
            $table->json('display_articles_4_block');
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
        Schema::dropIfExists('main_page_models');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutPageModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_page_models', function (Blueprint $table) {
            $table->id();
            $table->json('meta_title');
            $table->json('meta_description');
            $table->json('meta_keywords');
            $table->json('title');
            $table->json('based');
            $table->string('big_img')->nullable();
            $table->string('small_img')->nullable();
            $table->json('title_to_the_left_of_the_img');
            $table->json('text_to_the_left_of_the_img');
            $table->json('large_text');
            $table->json('left_small_text');
            $table->json('right_small_text');
            $table->json('gallery')->nullable();
            $table->json('creeping_line');
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
        Schema::dropIfExists('about_page_models');
    }
}

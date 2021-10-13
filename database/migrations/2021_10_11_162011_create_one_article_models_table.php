<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOneArticleModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('one_article_models', function (Blueprint $table) {
            $table->id();
            $table->json('meta_title');
            $table->json('meta_description');
            $table->json('meta_keywords');

            $table->date('create_date')->nullable();
            $table->json('article_title');
            $table->json('slug');
            $table->foreignId('author_id')->nullable()->constrained('one_author_models')->onDelete('set null');
            $table->json('interview');
            $table->json('video_maker');

            $table->string('main_image')->nullable();
            $table->json('social_label');
            $table->json('social_network');
            $table->json('blocks');
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
        Schema::dropIfExists('one_article_models');
    }
}

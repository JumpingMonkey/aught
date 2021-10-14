<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareerPageModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('career_page_models', function (Blueprint $table) {
            $table->id();
            $table->json('meta_title');
            $table->json('meta_description');
            $table->json('meta_keywords');
            $table->json('title');
            $table->json('description');
            $table->json('vacancies')->nullable();
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
        Schema::dropIfExists('career_page_models');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestPageModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_page_models', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->json('description');
            $table->json('name_field_title');
            $table->json('phone_field_title');
            $table->json('email_field_title');
            $table->json('massage_field_title');
            $table->json('file_field_title');
            $table->json('file_field_description');
            $table->json('btn_title');
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
        Schema::dropIfExists('request_page_models');
    }
}

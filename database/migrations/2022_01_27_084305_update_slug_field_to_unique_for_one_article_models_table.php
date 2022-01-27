<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSlugFieldToUniqueForOneArticleModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('one_article_models', function (Blueprint $table) {
            $table-> string('slug')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('one_article_models', function (Blueprint $table) {
            $table->dropUnique('one_article_models_slug_unique');
        });
    }
}

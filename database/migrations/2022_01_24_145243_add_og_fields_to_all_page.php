<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOgFieldsToAllPage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('privacy_policy_models', function (Blueprint $table) {
            $table->json('og_title')->nullable();
            $table->json('og_description')->nullable();
            $table->string('og_img')->nullable();
        });

        Schema::table('one_author_models', function (Blueprint $table) {
            $table->json('og_title')->nullable();
            $table->json('og_description')->nullable();
            $table->string('og_img')->nullable();
        });

        Schema::table('one_category_models', function (Blueprint $table) {
            $table->json('og_title')->nullable();
            $table->json('og_description')->nullable();
            $table->string('og_img')->nullable();
        });

        Schema::table('one_article_models', function (Blueprint $table) {
            $table->json('og_title')->nullable();
            $table->json('og_description')->nullable();
            $table->string('og_img')->nullable();
        });

        Schema::table('about_page_models', function (Blueprint $table) {
            $table->json('og_title')->nullable();
            $table->json('og_description')->nullable();
            $table->string('og_img')->nullable();
        });
        Schema::table('career_page_models', function (Blueprint $table) {
            $table->json('og_title')->nullable();
            $table->json('og_description')->nullable();
            $table->string('og_img')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('privacy_policy_models', function (Blueprint $table) {
            $table->dropColumn('og_title');
            $table->dropColumn('og_description');
            $table->dropColumn('og_img');
        });

        Schema::table('one_author_models', function (Blueprint $table) {
            $table->dropColumn('og_title');
            $table->dropColumn('og_description');
            $table->dropColumn('og_img');
        });

        Schema::table('one_category_models', function (Blueprint $table) {
            $table->dropColumn('og_title');
            $table->dropColumn('og_description');
            $table->dropColumn('og_img');
        });

        Schema::table('one_article_models', function (Blueprint $table) {
            $table->dropColumn('og_title');
            $table->dropColumn('og_description');
            $table->dropColumn('og_img');
        });

        Schema::table('about_page_models', function (Blueprint $table) {
            $table->dropColumn('og_title');
            $table->dropColumn('og_description');
            $table->dropColumn('og_img');
        });
        Schema::table('career_page_models', function (Blueprint $table) {
            $table->dropColumn('og_title');
            $table->dropColumn('og_description');
            $table->dropColumn('og_img');
        });
    }
}

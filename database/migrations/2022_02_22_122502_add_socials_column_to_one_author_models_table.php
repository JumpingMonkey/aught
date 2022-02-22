<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSocialsColumnToOneAuthorModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('one_author_models', function (Blueprint $table) {
            $table->string('apple_music')->nullable();
            $table->string('spotify')->nullable();
            $table->string('band_camp')->nullable();
            $table->string('web_site')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('one_author_models', function (Blueprint $table) {
            $table->dropColumn('apple_music');
            $table->dropColumn('spotify');
            $table->dropColumn('band_camp');
            $table->dropColumn('web_site');
        });
    }
}

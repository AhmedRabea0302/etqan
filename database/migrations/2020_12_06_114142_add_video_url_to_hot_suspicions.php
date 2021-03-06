<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVideoUrlToHotSuspicions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hot_suspicions', function (Blueprint $table) {
            $table->string('video_url')->nullable;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hot_suspicions', function (Blueprint $table) {
            $table->dropColumn('video_url');
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdAndUserTypeToMeets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meets', function (Blueprint $table) {
            $table->integer('user_id');
            $table->string('user_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meets', function (Blueprint $table) {
            $table->dropColumn(['user_id', 'user_type']);
        });
    }
}

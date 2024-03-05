<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string("avatar")->nullable();
            $table->string("work")->nullable();
            $table->string("location")->default("world");
            $table->string("skills")->nullable();
            $table->string("des")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn("avatar");
            $table->dropColumn("work");
            $table->dropColumn("location");
            $table->dropColumn("skills");
            $table->dropColumn("des");
        });
    }
}

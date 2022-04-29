<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gym_mangers', function (Blueprint $table) {
            $table->foreignId("gym_id")->references("id")->on("gyms");
            $table->foreignId("user_id")->references("id")->on("users");

           // $table->foreignId("city_manger_id")->references("id")->on("city_mangers");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gym_mangers', function (Blueprint $table) {
            //
        });
    }
};

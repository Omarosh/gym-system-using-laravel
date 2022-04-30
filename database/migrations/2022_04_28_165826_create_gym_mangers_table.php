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
        Schema::create('gym_mangers', function (Blueprint $table) {
            $table->id();
           // $table->string('name');
          //  $table->string('email');
            $table->string('city_name');
           // $table->string('national_id');
            //$table->string('passwd');
   



            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gym_mangers');
    }
};

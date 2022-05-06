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
        Schema::create('attended_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("trainee_id")->references("id")->on("trainees");
            $table->foreignId("training_session_id")->references("id")->on("training_sessions");
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
        Schema::dropIfExists('reserved_sessions');
    }
};

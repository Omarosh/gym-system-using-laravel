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
        Schema::create('purchase_operations', function (Blueprint $table) {
            $table->id();
            $table->foreignId("trainee_id")->references("id")->on("trainees");
            $table->foreignId("package_id")->references("id")->on("training_packages");
            $table->foreignId("gym_id")->references("id")->on("gyms");
            $table->foreignId("created_by_id")->references("id")->on("users");
            $table->integer('price');
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
        Schema::dropIfExists('purchase_operations');
    }
};

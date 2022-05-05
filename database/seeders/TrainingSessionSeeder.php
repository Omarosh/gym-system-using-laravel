<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TrainingSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\TrainingSession::factory(1)->create();
    }
}

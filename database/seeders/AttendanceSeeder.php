<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Attendance::factory(1)->create();
    }
}

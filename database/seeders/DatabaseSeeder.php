<?php

namespace Database\Seeders;

use App\Models\CityManger;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name'=>'admin',
            'guard_name'=>'web'
        ]);

        DB::table('roles')->insert([
            'name'=>'city_manager',
            'guard_name'=>'web'
        ]);

        DB::table('roles')->insert([
            'name'=>'gym_manager',
            'guard_name'=>'web'
        ]);

        $this->call([
            CityMangerSeeder::class,
            GymSeeder::class,
        ]);
    }
}

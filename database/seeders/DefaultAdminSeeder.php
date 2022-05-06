<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

use yajra\Datatables\Datatables;
use App\Models\CityManger;
use Illuminate\Support\Facades\File;

use App\Http\Requests\StoreCityManagerRequest;

class DefaultAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =  User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456'),
        ])->id;
        
        $role_id = DB::table('roles')->where('name', 'admin')->value('id');
        User::find($user)->roles()->sync($role_id) ;
    }
}
// command to run DefaultAdminSeeder
// php artisan db:seed --class=DefaultAdminSeeder

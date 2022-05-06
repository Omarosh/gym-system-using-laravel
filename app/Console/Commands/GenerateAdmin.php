<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class GenerateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin {--email=} {--password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generating Admins';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->option('email');
        $pass = $this->option('password');

        $user =  User::create([
            'name' => 'Admin',
            'email' => $email,
            'password' => Hash::make($pass),
        ])->id;
        
        $role_id = DB::table('roles')->where('name', 'admin')->value('id');
        User::find($user)->roles()->sync($role_id) ;
    }
}

// example
// php artisan create:admin --email=admin2@gmail.com --password=12345678

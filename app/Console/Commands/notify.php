<?php

namespace App\Console\Commands;

use App\Mail\MissingYouMail;
use App\Models\Trainee;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class notify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:users-not-logged-in-for-month';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = Trainee::whereDate("last_login" ,"<=",Carbon::now()->subDays(30))->get();
        dd($users);
        foreach ($users as  $user) {

            Mail::to($user->email)->send(new MissingYouMail($user));

        }

        return 0;
    }
    
}

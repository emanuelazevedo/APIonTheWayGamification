<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;


use App\User;
use App\Mission;
use App\Objective;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        // TODO Ter este schedulle a marcar as missoes

        $schedule->call(function () {


            $users = User::all();

            foreach($users as $user){
                $mission = Mission::find(rand(1, 6));
                $data = ['state'=>false, 'score'=>0, 'user_id'=>$user->id, 'mission_id'=>$mission->id];
                $objective = Objective::create($data);
            }

        })->everyMinute();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

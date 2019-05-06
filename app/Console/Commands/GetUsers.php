<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class GetUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getusers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all users in the system';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::all();

        $users->each(function ($user) {
            echo $user->id . '. ' . $user->first_name . ' ' . $user->last_name . ' / ' . $user->email . "\n";
        });
    }
}

<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Http\Controllers\Api\tokendeleteController;

class tokendelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:tokendelete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'token消してくれるよ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tokendelete_controller = app()->make('App\Http\Controllers\Api\tokendeleteController');
        $tokendelete_controller->tokendelete();

    }
}

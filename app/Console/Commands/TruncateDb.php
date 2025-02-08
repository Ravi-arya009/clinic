<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TruncateDb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:truncate-db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
{
    // Drop the entire database
    DB::statement('DROP DATABASE ' . env('DB_DATABASE'));

    // Create the database again
    DB::statement('CREATE DATABASE ' . env('DB_DATABASE'));

    // Run migration command
    $this->call('migrate');

    // Run seed command
    $this->call('db:seed');
}
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class RefreshClinic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh_clinic';

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
        $this->info('Starting refresh...');

        $command = '/Applications/XAMPP/xamppfiles/bin/mysql -u root -e "DROP DATABASE clinic;"';

        // Using exec() to capture return code
        $result = exec($command, $output, $returnCode);

        $this->info('Database dropped successfully.');

        try {
            DB::statement('CREATE DATABASE clinic;');
            $this->info('Database created successfully.');
        } catch (\Exception $e) {
            $this->error('Failed to create database: ' . $e->getMessage());
            return 1;
        }

        $migrateResult = Artisan::call('migrate');
        if ($migrateResult === 0) {
            $this->info('Migrations completed successfully.');
        } else {
            $this->error('Migration process failed with code: ' . $migrateResult);
            return 1;
        }

        $seedResult = Artisan::call('db:seed');
        if ($seedResult === 0) {
            $this->info('Database seeded successfully.');
        } else {
            $this->error('Seeding process failed with code: ' . $seedResult);
            return 1;
        }

        $this->info('Refresh Done.');
        return 0;
    }
}

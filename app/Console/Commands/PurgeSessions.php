<?php

namespace App\Console\Commands;

use App\Models\Session;
use Illuminate\Console\Command;

class PurgeSessions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sessions:purge';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes old sessions and related data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Session::query()->where('created_at', '<', now()->subSeconds(config('session.purge_timeout')))->delete();
        // Registered devices and remote scans will be deleted automatically by the database
        return 0;
    }
}

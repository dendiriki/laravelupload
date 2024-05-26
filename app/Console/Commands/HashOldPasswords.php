<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class HashOldPasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'passwords:hash-old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hash all old passwords in the database that are not hashed yet';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            // Assuming plain text passwords do not contain '$2y$' (bcrypt hash identifier)
            if (!Hash::needsRehash($user->password)) {
                $user->password = Hash::make($user->password);
                $user->save();
                $this->info("Hashed password for user: {$user->username}");
            }
        }

        $this->info('All old passwords have been hashed.');
        return 0;
    }
}

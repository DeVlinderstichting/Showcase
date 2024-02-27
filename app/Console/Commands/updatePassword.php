<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Hash;

class updatePassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:change-password {id : The ID of the user} {newPassword : The new password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change user password';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $userId = $this->argument('id');
        $newPassword = $this->argument('newPassword');

        $user = \App\Models\User::find($userId);

        if (!$user) {
            $this->error('User not found.');
            return 1; // Error exit code
        }

        $user->password = Hash::make($newPassword);
        $user->save();

        $this->info('Password changed successfully.');
        return 0; // Success exit code
    }
}

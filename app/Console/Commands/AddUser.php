<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\User;
use Symfony\Component\Console\Command\Command;
use Illuminate\Validation\Rules\Password;

class AddUser extends AbstractCommand
{
    /**
     * The login and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-user {login} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new user';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $login    = $this->argument('login');
        $password = $this->argument('password');

        $isValidData = $this->validateData(
            [
                'login'    => $login,
                'password' => $password,
            ],
            [
                'login'    => ['min:5', 'max:20', 'unique:users', 'regex:/^[a-zA-Z0-9_]+$/'],
                'password' => [Password::min(8), 'max:30'],
            ]
        );

        if(!$isValidData) {
            return Command::FAILURE;
        }

        User::create(['login' => $login, 'password' => $password]);

        $this->info("The user $login created successfully!");

        return Command::SUCCESS;
    }
}

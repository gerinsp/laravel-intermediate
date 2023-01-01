<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class Createuser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel:adduser
                            {--nm|name= : Input your name}
                            {--e|email= : Input your email}
                            {--p|pass= : Input your password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create default user';

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
     * @return int
     */
    public function handle()
    {
        
        // $name = $this->ask('Input name!');
        // $email = $this->ask('Input your email!');
        // $password = $this->secret('Input your password!');

        // $this->line("User: {$name} <{$email}>");

        $this->line($this->option('name') . ' ' . '<' . $this->option('email') . '>');

        if($this->confirm('Do you wish to continue?')) {
            $user = new User();

            $user->name = $this->option('name');
            $user->email = $this->option('email');
            $user->password = Hash::make($this->option('pass'));

            $user->save();

            $this->info('User has been created!');
        } else {
            $this->error('Canceled!');
        }

        $this->line('Done!');
    }
}

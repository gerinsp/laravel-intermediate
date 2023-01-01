<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class DailyWord extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:word';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily email to all users';

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
        $words = [
            'abbetarion' => 'a state or condition markedly different form norm',
            'convivial' => 'occupied with or fond of the pleasure of good company',
            'diaphanous' => 'so thin as to transmit light',
            'elegy' => 'a mournful poem a lament for the dead',
            'ostensible' => 'appearing as such but not necessarily so'
        ];

        $users = User::all();
        foreach($users as $user) {
            $key = array_rand($words);
            $value = $words[$key];

            Mail::raw("{$key} -> {$value}", function ($mail) use ($user) {
                $mail->from('mail@admin.com');
                $mail->to($user->email)
                ->subject('Word of the day');
            });

            sleep(3);
        }
    }
}

<?php

namespace App\Jobs;

use App\Models\User;
use App\Mail\SendMailable;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Mail::to('mail@admin.com')
        //         ->send(new SendMailable);

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

<?php

namespace App\Listeners;

use App\Events\Userlogged;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenerateLog
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\Userlogged  $event
     * @return void
     */
    public function handle(Userlogged $event)
    {
        $message = now() . ' ' . $event->request->text;
        Storage::append('file.log', $message);
    }
}

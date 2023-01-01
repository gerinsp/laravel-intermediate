<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Laravelcommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel:basic
                            {argument : Ini adalah deskripsi argument}
                            {--o|opsi= : Ini adalah deskripsi opsi}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Laravel basic command';

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
        $this->info('ini info');
        $this->error('ini error');
        $this->line('ini baris');

        $this->line(print_r($this->options()) . ' ' . print_r($this->arguments()));
        $this->line($this->option('opsi') . ' ' . $this->argument('argument'));

        $name = $this->ask("What is your name?");
        $password = $this->secret("Input your password");

        if($this->confirm("Do you want to continue?")) {
            $this->line($name . ' ' . $password);
        }
    }
}

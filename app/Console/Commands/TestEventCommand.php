<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestEventCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pusher:notification {msg}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'pusher notification';

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
     * @return mixed
     */
    public function handle()
    {
        //
        event(new \App\Events\NotificationEvent($this->argument('msg')));//触发TestEvent事件
    }
}

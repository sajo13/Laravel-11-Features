<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendWelcomeEmail implements ShouldQueue
{
    use Dispatchable, Queueable, interactsWithQueue, SerializesModels;

    public  $tries = 10;
    public $maxExceptions = 2;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {

        throw new \Exception('failed');

        return $this->release(2);
    }

    public function failed($e)
    {
        info('failed');
    }
}

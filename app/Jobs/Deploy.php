<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldBeUniqueUntilProcessing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;

class Deploy implements ShouldQueue, ShouldBeUniqueUntilProcessing
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        info('Started deploy job');

        sleep(5);

        info('Finished deploy job');
    }

    public function uniqueId()
    {
        return 'deployments';
    }

    public function uniqueFor()
    {
        return 60;
    }
    public function middleware()
    {
        return  [
            new WithoutOverlapping('deployments', 10)
        ];
    }
}

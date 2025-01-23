<?php

namespace App\Jobs\News;

use App\Services\Aggregations\GuardianNews;
use App\Services\Aggregations\NewsContext;
use App\Services\Aggregations\NewsOrgNews;
use App\Services\Aggregations\NytNews;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class NewsAggregationJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct() {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->handleGaurdianNews();
        $this->handleNytNews();
        $this->handleNewsOrgNews();
    }

    /**
     * Execute the gaurdian job.
     */
    public function handleGaurdianNews(): void
    {
        $ctx = new NewsContext(
            app(GuardianNews::class)
        );
        $ctx->fetch();
        $ctx->store();
    }

    /**
     * Execute the job.
     */
    public function handleNytNews(): void
    {
        $ctx = new NewsContext(
            app(NytNews::class)
        );
        $ctx->fetch();
        $ctx->store();
    }

    /**
     * Execute the job.
     */
    public function handleNewsOrgNews(): void
    {
        $ctx = new NewsContext(
            app(NewsOrgNews::class)
        );
        $ctx->fetch();
        $ctx->store();
    }
}

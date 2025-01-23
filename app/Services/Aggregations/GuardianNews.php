<?php

namespace App\Services\Aggregations;

use App\Traits\ConsumeExternalService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class GuardianNews implements Aggregator
{
    use ConsumeExternalService;
    protected Collection $news;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->news = collect();
    }

    /**
     * Fetch news from external service
     *
     */
    public function fetch(): void
    {
        $results = json_decode($this->request(
            config('services.news.guardian.endpoint'),
            [
                'from-date' => now()->format('Y-m-d'),
                'key' => config('services.news.guardian.key')
            ]
        ));
        foreach ($results->response->results as $news) {

        }
    }

    /**
     * Store news in database
     *
     */
    public function store(): void
    {
        //
    }
}

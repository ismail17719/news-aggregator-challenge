<?php

namespace App\Services\Aggregations;

use App\Traits\ConsumeExternalService;

class NewsOrgNews implements Aggregator
{
    use ConsumeExternalService;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Fetch news from external service
     *
     */
    public function fetch(): void
    {
        //
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

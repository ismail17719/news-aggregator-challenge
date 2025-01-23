<?php

declare(strict_types=1);

namespace App\Services\Aggregations;

class NewsContext
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected Aggregator $aggregator)
    {
    }

    /**
     * Fetch news from external service
     *
     */
    public function fetch(): void
    {
        $this->aggregator->fetch();
    }

    /**
     * Store news in database
     *
     */
    public function store(): void
    {
        $this->aggregator->store();
    }
}

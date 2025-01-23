<?php

declare(strict_types=1);

namespace App\Services\Aggregations;

interface Aggregator
{
    public function fetch(): void;
    public function store(): void;
}

<?php

declare(strict_types=1);

namespace App\Dtos\News;

use App\Enums\News\ArticleSource;
use Carbon\Carbon;

class ArticleDto
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $title,
        public string $url,
        public ArticleSource $source,
        public string|null $thumb = null,
        public Carbon $published_at = now(),
    )
    {
    }
}

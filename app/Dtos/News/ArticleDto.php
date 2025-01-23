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
        public readonly string $title,
        public readonly string $url,
        public readonly ArticleSource $source,
        public readonly string|null $thumb = null,
        public readonly Carbon|null $published_at = null,
    )
    {
    }
}

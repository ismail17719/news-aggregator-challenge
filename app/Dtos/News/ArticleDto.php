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
        public readonly ?string $author = null,
        public readonly ?string $category = null,
        public readonly ?string $thumb = null,
        public readonly ?Carbon $published_at = null,
    ) {}
}

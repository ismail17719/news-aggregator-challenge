<?php

namespace App\Enums\News;

enum ArticleSource
{
    case GUARDIAN;
    case NYT;
    case NEWSORG;

    public function label(): string
    {
        return match ($this) {
            self::GUARDIAN => 'The Guardian',
            self::NYT => 'New York Times - NYT',
            self::NEWSORG => 'News API Org',
        };
    }
}

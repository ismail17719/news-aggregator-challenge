<?php

declare(strict_types=1);

namespace App\Services\News;

use App\Enums\News\ArticleSource;
use App\Models\News\Article;
use Illuminate\Pagination\LengthAwarePaginator;

class ArticleService
{
    /**
     * Create a new class instance.
     */
    public function getAll(): array
    {
        return Article::filter(request()->only(
            'search',
                'from',
                'to',
                'source',
                'author',
                'category',
            ))
            ->paginate()
            ->withQueryString()
            ->through(fn (Article $article) => [
                'id' => $article->id,
                'title' => $article->title,
                'url' => $article->url,
                'source' => $article->source,
                'source_label' => ArticleSource::from($article->source)->label(),
                'author' => $article->author,
                'category' => $article->category,
                'thumb' => $article->thumb,
                'published_at' => $article->published_at,
            ])
            ->items();
    }
}

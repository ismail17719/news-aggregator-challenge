<?php

declare(strict_types=1);

namespace App\Services\Aggregations;

use App\Actions\News\StoreArticleAction;
use App\Dtos\News\ArticleDto;
use App\Enums\News\ArticleSource;
use App\Traits\ConsumeExternalService;
use Illuminate\Support\Collection;
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
            $this->news->push( new ArticleDto(
                $news->webTitle,
                $news->webUrl,
                ArticleSource::GUARDIAN
            ));
        }
    }

    /**
     * Store news in database
     *
     */
    public function store(): void
    {
        foreach ($this->news as $article) {
            app(StoreArticleAction::class)->__invoke($article);
        }
    }
}

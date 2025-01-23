<?php

namespace App\Services\Aggregations;

use App\Actions\News\StoreArticleAction;
use App\Dtos\News\ArticleDto;
use App\Enums\News\ArticleSource;
use App\Traits\ConsumeExternalService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class NewsOrgNews implements Aggregator
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
            config('services.news.newsorg.endpoint'),
            [
                'q' => 'a',
                'from' => now()->subDays(1)->format('Y-m-d'),
                'apiKey' => config('services.news.newsorg.key')
            ]
        ));
        foreach ($results->articles as $news) {
            $this->news->push( new ArticleDto(
                title: $news->title,
                url: $news->url,
                source: ArticleSource::NEWSORG,
                thumb: $news->urlToImage,
                published_at: today()
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

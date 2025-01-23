<?php

namespace App\Services\Aggregations;

use App\Actions\News\StoreArticleAction;
use App\Dtos\News\ArticleDto;
use App\Enums\News\ArticleSource;
use App\Traits\ConsumeExternalService;
use Illuminate\Support\Collection;

class NytNews implements Aggregator
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
            config('services.news.nyt.endpoint'),
            [
                'q' => 'a',
                'begin_date' => now()->format('Ymd'),
                'end_date' => now()->format('Ymd'),
                'api-key' => config('services.news.nyt.key')
            ]
        ));
        foreach ($results->results as $news) {
            $this->news->push( new ArticleDto(
                title: $news->title,
                url: $news->url,
                source: ArticleSource::NYT,
                thumb: count($news->multimedia) > 0 ? $news->multimedia[0]->url : null,
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

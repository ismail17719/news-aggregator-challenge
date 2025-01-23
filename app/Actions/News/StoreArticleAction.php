<?php

declare(strict_types=1);

namespace App\Actions\News;

use App\Dtos\News\ArticleDto;
use App\Models\News\Article;
use Illuminate\Support\Str;

class StoreArticleAction
{
    public function __invoke(ArticleDto $dto): Article
    {
        $article = new Article();
        $article->id = Str::uuid();
        $article->title = $dto->title;
        $article->url = $dto->url;
        $article->source = $dto->source->name;
        $article->thumb = $dto->thumb;
        $article->published_at = $dto->published_at;
        $article->save();

        return $article;
    }
}

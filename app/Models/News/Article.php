<?php

namespace App\Models\News;

use Database\Factories\News\ArticleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /** @use HasFactory<\Database\Factories\News\ArticleFactory> */
    use HasFactory;

    protected static function newFactory(): ArticleFactory
    {
        return ArticleFactory::new();
    }
}

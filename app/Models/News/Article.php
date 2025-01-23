<?php

namespace App\Models\News;

use Database\Factories\News\ArticleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $casts = [
        'id' => 'string',
        'published_at' => 'date',
    ];

    protected static function newFactory(): ArticleFactory
    {
        return ArticleFactory::new();
    }
}

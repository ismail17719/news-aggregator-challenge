<?php

declare(strict_types=1);

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

    /**
     * The attributes that are mass assignable.
     */
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('title', 'like', '%'.$search.'%');
        })
            ->when(($filters['from'] ?? null) && ($filters['to'] ?? null), function ($query) use ($filters) {
                $query->whereBetween('published_at', [$filters['from'], $filters['to']]);
            })
            ->when($filters['from'] ?? null, function ($query, $from) {
                $query->where('published_at', '>=', $from);
            })
            ->when($filters['to'] ?? null, function ($query, $to) {
                $query->where('published_at', '<=', $to);
            })
            ->when($filters['source'] ?? null, function ($query, $source) {
                is_array($source) ?
                $query->whereIn('source', array_map('strtoupper', $source)) :
                $query->where('source', strtoupper($source));
            })
            ->when($filters['author'] ?? null, function ($query, $author) {
                is_array($author) ?
                $query->whereIn('author', $author) :
                $query->where('author', 'like', '%'.$author.'%');
            })
            ->when($filters['category'] ?? null, function ($query, $category) {
                is_array($category) ?
                $query->whereIn('source', array_map('strtolower', $category)) :
                $query->where('source', strtolower($category));
            });
    }

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): ArticleFactory
    {
        return ArticleFactory::new();
    }
}

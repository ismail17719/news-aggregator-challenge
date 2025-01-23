<?php

namespace Database\Factories\News;

use App\Enums\News\ArticleSource;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'title' => $this->faker->sentence(8),
            'url' => $this->faker->url(),
            'source' => $this->faker->randomElement(ArticleSource::cases())->name,
            'author' => $this->faker->name(),
            'category' => $this->faker->word(),
            'thumb' => $this->faker->optional(0.4)->imageUrl(),
            'published_at' => $this->faker->date(),
        ];
    }
}

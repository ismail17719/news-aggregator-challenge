<?php

namespace Tests\Feature\News;

use App\Models\News\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class GetArticleTest extends TestCase
{
    private array $articles = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->articles = $this->createArticlesInDatabase();
    }

    private function createArticlesInDatabase(int $count = 100): array
    {
        return Article::factory()
            ->count($count)
            ->create()
            ->toArray();
    }

    /**
     *
     */
    public function test_it_returns_200_success_response_with_expected_structure(): void
    {
        $response = $this->makeRequest();
        $response->assertStatus(status: Response::HTTP_OK);
        $response->assertJsonStructure([
            'code',
            'phrase',
            'status',
            'msg',
            'data' => [
                "total",
                "page",
                "last_page",
                "per_page",
                'records' => [
                    '*' => [
                        'id',
                        'title',
                        'url',
                        'source',
                        'source_label',
                        'author',
                        'category',
                        'thumb',
                        'published_at',
                    ],
                ],
            ]
        ]);
        $response->assertValid();

    }

    /**
     *
     */
    public function test_it_returns_200_success_response_with_expected_structure_for_filters(): void
    {
        $response = $this->makeRequest(
            params: [
               'source' => $this->articles[0]['source'],
            ]
        );
        $response->assertStatus(status: Response::HTTP_OK);
        $response->assertJsonStructure([
            'code',
            'phrase',
            'status',
            'msg',
            'data' => [
                "total",
                "page",
                "last_page",
                "per_page",
                'records' => [
                    '*' => [
                        'id',
                        'title',
                        'url',
                        'source',
                        'source_label',
                        'author',
                        'category',
                        'thumb',
                        'published_at',
                    ],
                ],
            ]
        ]);
        $response->assertValid();

    }


    private function makeRequest(array $params = [], array $headers = []): TestResponse
    {
        return $this->get(
            uri: route('api.articles.index') . '?' . http_build_query($params),
            headers: $headers
        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->articles, $this->paymentId);
    }
}

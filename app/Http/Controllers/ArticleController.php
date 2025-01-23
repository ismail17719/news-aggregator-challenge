<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\News\Article;
use App\Services\News\ArticleService;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ArticleController extends Controller
{
    use ApiResponser;

    public function __construct( protected ArticleService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->response(__('articles.response.index'), Response::HTTP_OK, $this->service->getAll());
    }
}

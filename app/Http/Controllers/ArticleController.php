<?php

namespace App\Http\Controllers;

use App\Services\News\ArticleService;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ArticleController extends Controller
{
    use ApiResponser;

    public function __construct(protected ArticleService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $articles = $this->service->getAll();

        return $this->response(__('articles.response.index'), Response::HTTP_OK, [
            'total' => $this->service->count(),
            'page' => $articles->currentPage(),
            'last_page' => $articles->lastPage(),
            'per_page' => $articles->perPage(),
            'records' => $articles->items(),
        ]);
    }
}

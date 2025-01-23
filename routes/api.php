<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/news/')->as('api.')->group(function () {
    /**
     * ==========================
     * Crews related routes
     * ==========================
     */
    Route::resource('articles', ArticleController::class)->names([
        'index' => 'articles.index',
    ])->only(['index']);
});

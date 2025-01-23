<?php

use App\Models\News\Article;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Article::all();
});

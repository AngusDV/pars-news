<?php


use AngusDV\ParsNews\Controllers\ArticleController;
use AngusDV\ParsNews\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::as('api.v1.')
    ->prefix('api/v1/')->middleware(["api"])->group(function () {
        Route::apiResource('article', ArticleController::class);
        Route::apiResource('comment', CommentController::class);
    });

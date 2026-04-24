<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RevisorController;
use Illuminate\Support\Facades\Route;
use Monolog\Handler\RedisPubSubHandler;

Route::get('/', [PublicController::class, 'homepage'])->name('homepage');

Route::get('create/article', [ArticleController::class, 'create'])->name('create.article');

Route::get('/article/index', [ArticleController::class, 'index'])->name('article.index');

Route::get('/show/article/{article}', [ArticleController::class, 'show'])->name('article.show');

Route::get('/category/{category}', [ArticleController::class, 'byCategory'])->name('byCategory');

Route::get('/revisor/index', [RevisorController::class, 'index'])->name('revisor.index');

Route::patch('/accept/{article}', [RevisorController::class, 'accept'])->name('accept');

Route::patch('/reject/{article}', [RevisorController::class, 'reject'])->name('reject');

Route::get('/revisor/index', [RevisorController::class, 'index'])->middleware('isRevisor')->name('revisor.index');

Route::get('/revisor/request', [RevisorController::class, 'becomeRevisor'])->middleware('auth')->name('become.revisor');

Route::get('/search/article', [ArticleController::class, 'searchArticles'])->name('article.search');

Route::post('/lingua/{lang}', [PublicController::class, 'setLanguage'])->name('setLocale');



// Gestione articoli backToReview e deleteArticle da parte del revisore
Route::patch('/revisor/back-to-review/{article}', [RevisorController::class, 'backToReview'])->middleware('isRevisor')->name('revisor.backToReview');
Route::delete('/revisor/delete-article/{article}', [RevisorController::class, 'deleteArticle'])->middleware('isRevisor')->name('revisor.deleteArticle');
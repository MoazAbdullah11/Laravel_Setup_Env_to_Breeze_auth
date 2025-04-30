<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/search', [SearchController::class, 'index'])->name('search.index');
Route::get('/search-results', [SearchController::class, 'search'])->name('search.ajax');

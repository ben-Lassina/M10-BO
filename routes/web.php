<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use Wave\Facades\Wave;
use Illuminate\Support\Facades\DB;


// Wave routes
Wave::routes();

use App\Http\Controllers\ImageController;


Route::get('/images/letter/{letter}', [ImageController::class, 'fetchByLetter']);
Route::get('/images/search', [ImageController::class, 'search']);
Route::get('/spreekwoorden', [ImageController::class, 'index'])->name('spreekwoorden.index');
Route::get('/images/search/{query?}', [ImageController::class, 'search']);

use App\Http\Controllers\QuoteController;
Route::get('/quote-of-the-day', [QuoteController::class, 'dailyQuote']);
Route::get('/quotes/{language}', [QuoteController::class, 'quotesByLanguage']);






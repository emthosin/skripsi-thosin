<?php

use App\Models\Criteria;
use App\Models\Alternative;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MatrixController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\AlternativeController;

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

Route::get('/test', [TestController::class, 'index']);

Route::get('/', function () {
  return view('contents.home', [
    'alternativeCount' => Alternative::count(),
    'criteriaCount' => Criteria::count(),
  ]);
})->middleware(['auth']);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::resource('/alternatives', AlternativeController::class)->except(['show'])->middleware('auth');
Route::resource('/criterias', CriteriaController::class)->except(['show'])->middleware('auth');
Route::resource('/matrices', MatrixController::class)->except(['show'])->middleware('auth');
Route::post('/matrices/truncate', [MatrixController::class, 'truncate'])->middleware('auth');
Route::get('/matrices/alternatives', [MatrixController::class, 'rank'])->middleware('auth');

Route::get('/count', [MatrixController::class, 'count'])->middleware('auth');

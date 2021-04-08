<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\HomeController;

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

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/home', function() {
        return view('welcome');
    });

    Route::post('/addRecipe', [HomeController::class, 'addRecipe'])->name('addRecipe');
    Route::post('/getRecipe', [HomeController::class, 'getRecipe'])->name('getRecipe');
    Route::post('/searchRecipes', [HomeController::class, 'searchRecipes'])->name('searchRecipes');
});

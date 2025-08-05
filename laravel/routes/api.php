<?php

use App\Http\Controllers\Api\CatalogueController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/test', function () {
    return response()->json([
        'success' => true,
        'message' => 'Call api thành công.'
    ]);
});

Route::get('catalogues', [CatalogueController::class, 'index']);
Route::get('catalogues/{slug}', [CatalogueController::class, 'show']);

<?php

use App\Http\Controllers\Api\{
    CatalogueController,
    LegalDocumentController,
    PostController,
    SettingController
};
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('catalogues', [CatalogueController::class, 'index']);
Route::get('catalogues/{slug}', [CatalogueController::class, 'show']);


Route::get('settings', [SettingController::class, 'show']);

Route::prefix('posts')
    ->controller(PostController::class)
    ->group(function () {
        Route::get('/',  'index');
        Route::get('latest', 'latest');
        Route::get('slider',  'getSliderPosts');
        Route::get('/{slug}',  'show');
    });

Route::prefix('legal-documents')
    ->controller(LegalDocumentController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::get('download/{file}', 'downloadFile');
        Route::get('{slug}', 'show');
    });

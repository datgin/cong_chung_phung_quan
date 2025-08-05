<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BulkActionController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'login'])->name('login');
        Route::post('login', [AuthController::class, 'authenticate']);
    });

    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('logout', [AuthController::class, 'logout'])->name('logout');

        Route::post('handle-bulk-action', [BulkActionController::class, 'handleBulkAction']);

        Route::group(['prefix' => 'media', 'controller' => MediaController::class], function () {
            Route::get('/', 'index');
            Route::post('upload', 'upload');
            Route::delete('destroy', 'destroy');
        });

        Route::prefix('catalogues')->controller(CatalogueController::class)->name('catalogues.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('create', 'store')->name('store');
            Route::get('{catalogue}/edit', 'edit')->name('edit');
            Route::put('{catalogue}/edit', 'update')->name('update');
        });

        Route::prefix('posts')->controller(PostController::class)->name('posts.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('create', 'store')->name('store');
            Route::get('{post}/edit', 'edit')->name('edit');
            Route::put('{post}/edit', 'update')->name('update');
        });
    });
});

Route::get('/', fn() => redirect()->route('admin.dashboard'));

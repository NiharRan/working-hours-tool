<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

Route::get('/live', function () {
    Artisan::call('optimize');
    Artisan::call('migrate');
    Artisan::call('key:generate');
});

Route::post('/change-local', function (\Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Session::put('local', $request->get('local'));
    return redirect()->back();
});

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [
        \App\Http\Controllers\DashboardController::class, 'index'
    ])->name('dashboard');
    Route::post('/activities', [
        \App\Http\Controllers\ActivityController::class, 'store'
    ])->name('activities.store');
    Route::put('/activities/{activity}', [
        \App\Http\Controllers\ActivityController::class, 'update'
    ])->name('activities.update');

    Route::group([
        'middleware' => ['admin'],
        'prefix' => 'admin',
    ], function () {

        /**
         * Admin panel routes
         * ----------------------------------------------------------
         * all those routes are responsible for admin panel activities
         */
        Route::get('/dashboard', [
            \App\Http\Controllers\Admin\DashboardController::class, 'index'
        ])->name('admin.dashboard');

        Route::resource('/users', \App\Http\Controllers\Admin\UserController::class, ['as' => 'admin']);
        Route::resource('/projects', \App\Http\Controllers\Admin\ProjectController::class, ['as' => 'admin']);
        Route::resource('/activities', \App\Http\Controllers\Admin\ActivityController::class, ['as' => 'admin']);
        Route::get('/activities/{activity}', [
            \App\Http\Controllers\Admin\ActivityController::class, 'stopActivity'
        ])->name('admin.activities.stop');
    });
});


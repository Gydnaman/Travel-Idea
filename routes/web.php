<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TravelIdeaController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TravelBookingController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Auth::routes();

Route::get('/', [WelcomeController::class, 'index']);
Route::get('/stores', [ContactController::class, 'index'])->name('stores.index');

Route::get('/home', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('travel-ideas/search', [TravelIdeaController::class, 'search'])->name('travel-ideas.search');
Route::get('travel-ideas/advanced-search', [TravelIdeaController::class, 'advancedSearch'])->name('travel-ideas.advanced-search');
Route::resource('travel-ideas', TravelIdeaController::class);

Route::post('/travel-ideas/{id}/comments', [CommentsController::class, 'store'])
    ->middleware('auth')
    ->name('comments.store');

Route::get('/travel-ideas/{id}/comments/latest', [CommentsController::class, 'fetchLatest'])
    ->name('comments.latest');

Route::post('/comments/{id}/interaction', [CommentsController::class, 'toggleInteraction'])
    ->middleware('auth')
    ->name('comments.interaction');

Route::get('travel-ideas/{id}/hotels', [TravelIdeaController::class, 'hotels'])->name('travel-ideas.hotels');

Route::get('/proxy-image', function(\Illuminate\Http\Request $request) {
    if (!$request->has('url')) return abort(400);
    $response = \Illuminate\Support\Facades\Http::get($request->query('url'));
    if ($response->successful()) {
        return response($response->body())->header('Content-Type', $response->header('Content-Type', 'image/png'));
    }
    return abort(404);
})->name('proxy.image');

<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\TribeController;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
    ]);
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('notes', [NotesController::class, 'index'])
    ->name('notes.all');

    Route::get('notes/{note}/edit', [NotesController::class, 'single'])
    ->name('notes.single');

    Route::get('notes/create', [NotesController::class, 'create'])
    ->name('notes.create');

    Route::post('notes', [NotesController::class, 'store'])
    ->name('notes.store');

    Route::put('notes/{note}', [NotesController::class, 'update'])
    ->name('notes.update');

    Route::get('tribes', [TribeController::class, 'index'])
    ->name('tribes.all');

    Route::get('tribes/{tribe}', [TribeController::class, 'single'])
    ->name('tribes.single');

    Route::get('tribes/create', [TribeController::class, 'single'])
    ->name('tribes.create');

    Route::get('tribes/{tribe}/inbox', [TribeController::class, 'inbox'])
    ->name('tribes.inbox');

    Route::get('tribes/{tribe}/archive', [TribeController::class, 'archive'])
    ->name('tribes.archive');

    Route::get('tribes/{tribe}/notes/{note}', [TribeController::class, 'note'])
    ->name('tribes.note');
});



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

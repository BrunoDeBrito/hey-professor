<?php

use App\Http\Controllers\{DashboardController, ProfileController, Question, QuestionController};

/* Controllers */
use Illuminate\Support\Facades\Route;

#region Dashboard
Route::get('/', function () {

    if (app()->isLocal()) {
        auth()->loginUsingId(1);

        return redirect(route('dashboard'));
    }

    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
#endregion

#region Middleware Auth
Route::middleware('auth')->group(function () {

    #region Question Routes
    Route::prefix('questions')->name('question.')->group(function () {

        #region Question Methods
        Route::get('', [QuestionController::class, 'index'])->name('index');
        Route::post('store', [QuestionController::class, 'store'])->name('store');
        Route::get('{question}/edit', [QuestionController::class, 'edit'])->name('edit');
        Route::put('{question}', [QuestionController::class, 'update'])->name('update');
        Route::delete('{question}', [QuestionController::class, 'destroy'])->name('destroy');
        #endregion

        #region Question Actions
        Route::post('like/{question}', Question\LikeController::class)->name('like');
        Route::post('unlike/{question}', Question\UnlikeController::class)->name('unlike');
        Route::put(' publish/{question}', Question\PublishController::class)->name('publish');
        #endregion
    });
    #endregion

    #region Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    #endregion

});
#endregion

require __DIR__ . '/auth.php';

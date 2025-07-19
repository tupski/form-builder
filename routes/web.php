<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\FormBuilderController;
use App\Http\Controllers\FormSubmissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Form routes
    Route::resource('forms', FormController::class);
    Route::get('forms/{form}/builder', [FormBuilderController::class, 'show'])->name('forms.builder');
    Route::post('forms/{form}/fields', [FormBuilderController::class, 'saveFields'])->name('forms.save-fields');
    Route::post('forms/{form}/conditional-rules', [FormBuilderController::class, 'saveConditionalRules'])->name('forms.save-conditional-rules');
    Route::get('forms/{form}/submissions', [FormController::class, 'submissions'])->name('forms.submissions');
    Route::get('forms/{form}/export', [FormController::class, 'exportSubmissions'])->name('forms.export-submissions');
    Route::post('forms/{form}/generate-short-url', [FormController::class, 'generateShortUrl'])->name('forms.generate-short-url');
    Route::post('forms/{form}/share-settings', [FormController::class, 'saveShareSettings'])->name('forms.save-share-settings');

    // Admin routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/forms', [FormController::class, 'adminIndex'])->name('forms.index');
        Route::get('/submissions', [FormSubmissionController::class, 'adminIndex'])->name('submissions.index');
        Route::resource('/users', \App\Http\Controllers\Admin\UserController::class);
        Route::post('/users/{user}/toggle-status', [\App\Http\Controllers\Admin\UserController::class, 'toggleStatus'])->name('users.toggle-status');
        Route::get('/translations', [TranslationController::class, 'index'])->name('translations.index');
        Route::post('/translations', [TranslationController::class, 'store'])->name('translations.store');
        Route::put('/translations/{translation}', [TranslationController::class, 'update'])->name('translations.update');
        Route::delete('/translations', [TranslationController::class, 'destroy'])->name('translations.destroy');
        Route::post('/languages', [TranslationController::class, 'createLanguage'])->name('languages.store');
        Route::post('/languages/{language}/toggle', [TranslationController::class, 'toggleLanguage'])->name('languages.toggle');
        Route::post('/languages/{language}/set-default', [TranslationController::class, 'setDefault'])->name('languages.set-default');
        Route::post('/switch-language', [TranslationController::class, 'switchLanguage'])->name('switch-language');
    });
});

// Public form submission routes
Route::get('/form/{form:slug}', [FormSubmissionController::class, 'show'])->name('form.show');
Route::post('/form/{form:slug}', [FormSubmissionController::class, 'store'])->name('form.submit');

// Short URL and Custom URL routes
Route::get('/f/{url}', [FormSubmissionController::class, 'showByUrl'])->name('form.show.url');
Route::post('/f/{url}', [FormSubmissionController::class, 'storeByUrl'])->name('form.submit.url');

require __DIR__.'/auth.php';

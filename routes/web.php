<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\FormBuilderController;
use App\Http\Controllers\FormSubmissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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

    // Admin routes
    Route::middleware('admin')->group(function () {
        Route::get('/admin/forms', [FormController::class, 'adminIndex'])->name('admin.forms.index');
        Route::get('/admin/submissions', [FormSubmissionController::class, 'adminIndex'])->name('admin.submissions.index');
    });
});

// Public form submission routes
Route::get('/form/{form:slug}', [FormSubmissionController::class, 'show'])->name('form.show');
Route::post('/form/{form:slug}', [FormSubmissionController::class, 'store'])->name('form.submit');

require __DIR__.'/auth.php';

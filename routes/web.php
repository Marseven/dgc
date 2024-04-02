<?php

use App\Http\Controllers\Admin\EntrepriseController;
use App\Http\Controllers\Front\WelcomeController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', [WelcomeController::class, 'form'])->name('home');
Route::get('/form', [WelcomeController::class, 'form'])->name('form');
Route::post('/register-form', [WelcomeController::class, 'register'])->name('register-form');

Route::get('/contact', [WelcomeController::class, 'contact'])->name('contact');
Route::post('/contact', [WelcomeController::class, 'sendMessage'])->name('sendMessage');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function ($id, $hash, Request $request) {
    $user = User::findOrFail($id);
    if (!$user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
    }
    return redirect('/login');
})->middleware(['signed'])->name('verification.verify');

Auth::routes();

Route::get('log-out', function () {
    Auth::logout();
    return redirect('/login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [EntrepriseController::class, 'index'])->name('dashboard');
    Route::get('/entreprise', [EntrepriseController::class, 'entreprise'])->name('entreprise');
    Route::get('/importation', [EntrepriseController::class, 'importation'])->name('importation');
    Route::get('/activite', [EntrepriseController::class, 'activite'])->name('activite');
    Route::get('/export/{importation}', [EntrepriseController::class, 'export'])->name('export');
    Route::post('/update/importation/{importation}', [EntrepriseController::class, 'updateImportation'])->name('update-importation');
    Route::get('/get/importation', [EntrepriseController::class, 'ajaxItem'])->name('get-importation');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthGithubController;
use App\Http\Controllers\AuthAzureController;



Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->get('/tramites', function () {
    return Inertia\Inertia::render('Tramites');
})->name('tramites');

Route::get('/sign-in/github', [AuthGithubController::class, 'github']);
Route::get('/sign-in/github/redirect',  [AuthGithubController::class, 'githubRedirect']);

Route::get('/login/azure', '\App\Http\Middleware\Azure@azure');
Route::get('/login/azurecallback', '\App\Http\Middleware\Azure@azurecallback');

// Route::get('/sign-in/azure', [AuthAzureController::class, 'azure']);
// Route::get('/sign-in/azure/redirect',  [AuthAzureController::class, 'azureRedirect']);

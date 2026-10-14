<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/insights', function () {
    return redirect('/#insights');
});

Route::get('/events', function () {
    return redirect()->away('https://marketech-apac.com/featured-events/');
});

// Public Form Submissions
Route::post('/contact/submit', [ContactController::class, 'submitContact'])->name('contact.submit');
Route::post('/newsletter/subscribe', [ContactController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');

// Graceful redirects for legacy auth/admin endpoints
Route::any('/login', function () {
    return redirect('/');
})->name('login');

Route::any('/admin/{any?}', function () {
    return redirect('/');
})->where('any', '.*')->name('admin.dashboard');

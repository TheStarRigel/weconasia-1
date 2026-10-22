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

// Brand Ecosystem Showcase Directory & Dedicated Pages
Route::get('/brands', function () {
    return view('brands.index');
})->name('brands.index');

Route::get('/marketech-apac', function () {
    return view('brands.marketech');
})->name('brands.marketech');

Route::get('/uptech-media', function () {
    return view('brands.uptech');
})->name('brands.uptech');

Route::get('/hr-forward-asia', function () {
    return view('brands.hrforward');
})->name('brands.hrforward');

// Brand URL Aliases
Route::get('/brands/marketech-apac', function () {
    return redirect()->route('brands.marketech');
});
Route::get('/brands/uptech-media', function () {
    return redirect()->route('brands.uptech');
});
Route::get('/brands/hr-forward-asia', function () {
    return redirect()->route('brands.hrforward');
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

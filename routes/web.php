<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Models\CmsContent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $sections = [
        'hero' => CmsContent::getSection('section_1_hero'),
        'about' => CmsContent::getSection('section_2_about'),
        'why' => CmsContent::getSection('section_3_why'),
        'events' => CmsContent::getSection('section_4_events'),
        'speakers' => CmsContent::getSection('section_5_speakers'),
        'insights' => CmsContent::getSection('section_6_insights'),
        'newsletter' => CmsContent::getSection('section_7_newsletter'),
        'pathways' => CmsContent::getSection('section_pathways'),
        'careers' => CmsContent::getSection('section_careers'),
        'contact' => CmsContent::getSection('section_9_contact'),
    ];

    return view('welcome', compact('sections'));
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

/*
|--------------------------------------------------------------------------
| Stealth Authentication Routes (No Visible Login Button)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/admin/login', [AuthController::class, 'showLogin']);
Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});
Route::post('/admin/login', [AuthController::class, 'authenticate'])->name('login.post');
Route::match(['get', 'post'], '/admin/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin CMS Management Routes (Requires Auth)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/section/{sectionKey}', [AdminController::class, 'updateSection'])->name('admin.section.update');
    Route::delete('/inquiry/{id}', [AdminController::class, 'deleteInquiry'])->name('admin.inquiry.delete');
    Route::delete('/subscriber/{id}', [AdminController::class, 'deleteSubscriber'])->name('admin.subscriber.delete');
});

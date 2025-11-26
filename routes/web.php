<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CaseStudyController;
use App\Models\Page;
use App\Models\Blog;
use App\Models\CaseStudy;

Route::get('/', function () {
    $page = Page::where('title', 'Home')->first();
    return view('home', compact('page'));
});

Route::get('/about', function () {
    $page = Page::where('title', 'About')->first();
    return view('about', compact('page'));
});

Route::get('/contact', function () {
    $page = Page::where('title', 'Contact')->first();
    return view('contact', compact('page'));
});

Route::get('/blog', function () {
    $blogs = Blog::all();
    return view('blog.index', compact('blogs'));
});

Route::get('/blog/{blog}', function (Blog $blog) {
    return view('blog.show', compact('blog'));
});

Route::get('/case-studies', function () {
    $caseStudies = CaseStudy::all();
    return view('case-studies.index', compact('caseStudies'));
});

Route::get('/case-studies/{caseStudy}', function (CaseStudy $caseStudy) {
    return view('case-studies.show', compact('caseStudy'));
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('pages', PageController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('case-studies', CaseStudyController::class);
});

require __DIR__.'/auth.php';

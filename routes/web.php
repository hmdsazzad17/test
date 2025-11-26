<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/services', function () {
    return view('services');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/blog', function () {
    return view('blog.index');
});

Route::get('/blog/single', function () {
    return view('blog.show');
});

Route::get('/case-studies', function () {
    return view('case-studies.index');
});

Route::get('/case-studies/single', function () {
    return view('case-studies.show');
});

Route::get('/faqs', function () {
    return view('faqs');
});

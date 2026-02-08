<?php

use App\Http\Controllers\Web\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('front.home');

// Optional pages mapped to controller methods
Route::get('/about', [HomeController::class, 'about'])->name('front.about');
Route::get('/projects', [HomeController::class, 'projects'])->name('front.projects');
Route::get('/blog', [HomeController::class, 'blog'])->name('front.blog');
Route::get('/contact', [HomeController::class, 'contact'])->name('front.contact');

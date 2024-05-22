<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/roles', function () {
        return view('roles');
    })->name('roles');
    Route::get('/admin', function () {
        return view('admin');
    })->name('admin');
    Route::get('/games', function () {
        return view('games');
    })->name('games');
    Route::get('/hangman', function () {
        return view('hangman');
    })->name('hangman');
    Route::get('/quiz', function () {
        return view('quiz');
    })->name('quiz');
    Route::get('/simon', function () {
        return view('simon');
    })->name('simon');
    
});

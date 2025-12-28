<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\Auth\AuthController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('welcome');

Route::get('/login', function () {
    return Inertia::render('auth/login');
})->name('login');

Route::get('/signup', function () {
    return Inertia::render('auth/signup');
})->name('signup');

// Authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Protected routes (example)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    
    Route::get('/exams', function () {
        return Inertia::render('dashboard/Exam/Exam');
    })->name('exams');
    
    Route::get('/students', function () {
        return Inertia::render('dashboard/Student/Student');
    })->name('students');
    
    Route::get('/monitoring', function () {
        return Inertia::render('dashboard/Monitoring/Monitoring');
    })->name('monitoring');
    
    Route::get('/announcement', function () {
        return Inertia::render('dashboard/Announcement/Announcement');
    })->name('announcement');
});

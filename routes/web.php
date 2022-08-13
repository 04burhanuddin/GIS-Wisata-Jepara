<?php

use App\Http\Controllers\DetailWisataController;
use App\Http\Livewire\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Wisata;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});


Auth::routes([
    // 'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/wisata', Wisata::class)->name('wisata')->middleware('auth');
Route::get('/wisata/{id}', [DetailWisataController::class, 'show'])->name('detail.wisata');
<?php

use App\Http\Livewire\Wisata;
use App\Http\Livewire\Dashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListWisataController;
use App\Http\Controllers\DetailWisataController;
use App\Http\Livewire\Detailwisata;
use App\Http\Livewire\Listwisata;

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
Route::get('/list-wisata', Listwisata::class)->name('list.wisata');
Route::get('/wisata/{id}', Detailwisata::class, 'mount')->name('detail.wisata');
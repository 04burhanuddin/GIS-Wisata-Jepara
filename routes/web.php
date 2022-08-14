<?php

use App\Http\Livewire\Listwisata;
use App\Http\Livewire\Detailwisata;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'reset' => false,
    'verify' => false,
]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/all-wisata', Listwisata::class)->name('list.wisata');
Route::get('/wisata/{id}', Detailwisata::class, 'mount')->name('detail.wisata');
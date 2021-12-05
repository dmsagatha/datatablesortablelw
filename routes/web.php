<?php

use App\Http\Livewire\Admin\Users\UsersTable;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth'])->group(function () {
  Route::get('/usuarios', UsersTable::class)->name('users.table');
});
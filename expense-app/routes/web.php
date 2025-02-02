<?php

use App\Livewire\ExpenseForm;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified', 'is_employee'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth'])->group(function () {

    Route::middleware(['is_employee'])->group(function () {
        Route::get('/expense/create', ExpenseForm::class)->name('expense.create');
        /* Route::get('/expenses', ExpenseForm::class)->name('expenses.index'); */
    });
});

require __DIR__.'/auth.php';

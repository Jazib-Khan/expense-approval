<?php

use App\Livewire\AllExpenses;
use App\Livewire\EmployeeExpenses;
use App\Livewire\ExpenseForm;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth'])->group(function () {

    Route::middleware(['is_employee'])->group(function () {
        Route::get('/expense/create', ExpenseForm::class)->name('expense.create');
        Route::get('/expenses', EmployeeExpenses::class)->name('expenses.index');
    });

    Route::middleware(['is_admin'])->group(function () {
        Route::get('/admin/expenses', AllExpenses::class)->name('admin.expenses');
    });
});

require __DIR__.'/auth.php';

<?php

namespace App\Livewire;

use App\Mail\ExpenseStatusUpdated;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class AllExpenses extends Component
{
    public function render()
    {
        // Retrieves and outputs all Expenses
        $expenses = Expense::all();
        return view('livewire.all-expenses', ['expenses' => $expenses]);
    }

    public function updateExpenseStatus($id, $status)
    {
        // Validate the status to ensure it's either 'approved' or 'rejected'
        if (!in_array($status, ['approved', 'rejected'])) {
            return;
        }

        // Find the expense and update its status
        $expense = Expense::findOrFail($id);
        $expense->status = $status;
        $expense->save();

        // Send email to user of request approval or rejection
        Mail::to($expense->user->email)->send(
            new ExpenseStatusUpdated(
                Auth::user()->email,
                $expense->status,
                $expense->category,
                $expense->description,
                $expense->amount,
                $expense->user->email,
            )
        );
    }
}

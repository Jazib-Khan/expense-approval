<?php

namespace App\Livewire;

use App\Models\Expense;
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
    }
}

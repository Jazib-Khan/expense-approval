<?php

namespace App\Livewire;

use App\Mail\ExpenseStatusUpdated;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;

class AllExpenses extends Component
{

    use WithPagination;

    public $search = '';

    public function render()
    {
        // Retrieves and outputs expenses based on search query for user names
        $expenses = Expense::when($this->search, function ($query) {
            $query->whereHas('user', function ($userQuery) {
                $userQuery->where('name', 'like', '%' . $this->search . '%');
            });
        })->paginate(5); // Paginates to 5 expense results

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

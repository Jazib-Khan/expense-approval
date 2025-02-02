<?php

namespace App\Livewire;

use App\Mail\ExpenseSubmitted;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;

class ExpenseForm extends Component
{
    use WithFileUploads;

    public $description, $amount, $category, $receipt_image;

    public function submitExpense()
    {
        // Validates expense inputs
        $this->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'category' => 'required|string|max:255',
            'receipt_image' => 'nullable|image|max:2048'
        ]);

        // Stores receipt path in directory
        $receiptPath = $this->receipt_image ? $this->receipt_image->store('receipts', 'public') : null;

        // Creates expense
        Expense::create([
            'user_id' => Auth::id(),
            'description' => $this->description,
            'amount' => $this->amount,
            'category' => $this->category,
            'receipt_image' => $receiptPath,
        ]);

        // Send email to admin for expense update
        Mail::to('admin@example.com')->send(
            new ExpenseSubmitted(
                Auth::user()->email,
                $this->description,
                $this->amount,
                $this->category
            )
        );

        session()->flash('message', 'Expense submitted successfully');
        $this->reset();

    }


    public function render()
    {
        return view('livewire.expense-form');
    }
}

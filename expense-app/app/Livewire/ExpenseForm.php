<?php

namespace App\Livewire;

use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class ExpenseForm extends Component
{
    use WithFileUploads;

    public $description, $amount, $category, $receipt_image;

    public function submitExpense()
    {
        $this->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'receipt_image' => 'nullable|image|max:2048'
        ]);

        $receiptPath = $this->receipt_image->store('receipts', 'public');

        Expense::create([
            'user_id' => Auth::id(),
            'description' => $this->description,
            'amount' => $this->amount,
            'category' => $this->category,
            'receipt_image' => $receiptPath,
        ]);

        session()->flash('message', 'Expense submitted successfully');
        $this->reset();

    }


    public function render()
    {
        return view('livewire.expense-form');
    }
}

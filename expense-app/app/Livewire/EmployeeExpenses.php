<?php

namespace App\Livewire;

use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EmployeeExpenses extends Component
{
    public function render()
    {
        // Returns expenses from logged in user
        return view('livewire.employee-expenses', [
            'expenses' => Expense::where('user_id' , Auth::id())->get()
        ]);
    }
}

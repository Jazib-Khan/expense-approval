<?php

namespace Tests\Unit;

use App\Livewire\AllExpenses;
use App\Mail\ExpenseStatusUpdated;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;
use Tests\TestCase;

class AllExpensesTest extends TestCase
{
    public function test_it_renders_correctly()
    {
        Livewire::test(AllExpenses::class)
            ->assertStatus(200)
            ->assertSee('Employee Expense Requests');
    }

    public function test_it_filters_expenses_by_search()
    {
        $user1 = User::factory()->create(['name' => 'John Smith']);
        $user2 = User::factory()->create(['name' => 'Michael Owen']);

        Expense::factory()->create(['user_id' => $user1->id, 'description' => 'Travel Expense']);
        Expense::factory()->create(['user_id' => $user2->id, 'description' => 'Office Supplies']);

        Livewire::test(AllExpenses::class)
            ->set('search', 'John')
            ->assertSee('John Smith')
            ->assertDontSee('Michael Owen');
    }

    public function test_it_approves_an_expense_and_sends_email()
    {
        Mail::fake();

        $user = User::factory()->create();
        $this->actingAs($user); // Ensure a logged-in user

        $expense = Expense::factory()->create(['user_id' => $user->id, 'status' => 'pending']);

        Livewire::test(AllExpenses::class)
            ->call('updateExpenseStatus', $expense->id, 'approved');

        $this->assertDatabaseHas('expenses', [
            'id' => $expense->id,
            'status' => 'approved',
        ]);

        Mail::assertSent(ExpenseStatusUpdated::class);
    }

    public function test_it_rejects_an_expense_and_sends_email()
    {
        Mail::fake();

        $user = User::factory()->create();
        $this->actingAs($user); // Ensure a logged-in user

        $expense = Expense::factory()->create(['user_id' => $user->id, 'status' => 'pending']);

        Livewire::test(AllExpenses::class)
            ->call('updateExpenseStatus', $expense->id, 'rejected');

        $this->assertDatabaseHas('expenses', [
            'id' => $expense->id,
            'status' => 'rejected',
        ]);

        Mail::assertSent(ExpenseStatusUpdated::class);
    }
}

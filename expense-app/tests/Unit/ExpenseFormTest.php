<?php

namespace Tests\Unit;

use App\Livewire\ExpenseForm;
use App\Mail\ExpenseSubmitted;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class ExpenseFormTest extends TestCase
{
    public function test_component_renders_correctly()
    {
        Livewire::test(ExpenseForm::class)
            ->assertStatus(200);
    }

    public function test_validation_fails_with_missing_required_fields()
    {
        Livewire::test(ExpenseForm::class)
            ->call('submitExpense')
            ->assertHasErrors([
                'description' => 'required',
                'amount' => 'required',
                'category' => 'required'
            ]);
    }

    public function test_expense_is_created_successfully()
    {
        $user = User::factory()->create();
        Auth::login($user);

        Livewire::actingAs($user)
            ->test(ExpenseForm::class)
            ->set('description', 'Office Supplies')
            ->set('amount', 50.00)
            ->set('category', 'Office')
            ->call('submitExpense');

        $this->assertDatabaseHas('expenses', [
            'user_id' => $user->id,
            'description' => 'Office Supplies',
            'amount' => 50.00,
            'category' => 'Office',
        ]);
    }

    public function test_receipt_upload_works()
    {
        Storage::fake('public');
        $user = User::factory()->create();
        Auth::login($user);

        $file = UploadedFile::fake()->image('receipt.jpg');

        Livewire::actingAs($user)
            ->test(ExpenseForm::class)
            ->set('description', 'Office Supplies')
            ->set('amount', 50.00)
            ->set('category', 'Office')
            ->set('receipt_image', $file)
            ->call('submitExpense');

        Storage::disk('public')->assertExists('receipts/' . $file->hashName());
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Expense;
use App\Services\ExpenseService;

class ExpenseServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testGetAllExpenses()
    {
        $user = User::factory()->create();

        $expenses = Expense::factory()->count(3)->create([
            'user_id' => $user->id,
        ]);

        $service = new ExpenseService();

        $fetchedExpenses = $service->getAllExpenses($user->id);

        $this->assertCount(3, $fetchedExpenses);

        $fetchedExpenses->each(function ($expense) use ($expenses) {
            $this->assertTrue($expenses->contains($expense));
        });
    }

    public function testStoreExpense()
    {
        $user = User::factory()->create();

        $expenseData = [
            'description' => 'Buy luggage to travel',
            'date' => '2024-01-21',
            'value' => 150.00
        ];

        $service = new ExpenseService();

        $expense = $service->storeExpense($expenseData, $user->id);

        $this->assertDatabaseHas('expenses', [
            'description' => 'Buy luggage to travel',
            'date' => '2024-01-21',
            'user_id' => $user->id,
            'value' => 150.00
        ]);

        $this->assertEquals('Buy luggage to travel', $expense->description);
        $this->assertEquals('2024-01-21', $expense->date);
        $this->assertEquals(150.00, $expense->value);
        $this->assertEquals($user->id, $expense->user_id);
    }

    public function testGetExpenseById()
    {
        $user = User::factory()->create();
        $expense = Expense::factory()->create(['user_id' => $user->id]);

        $service = new ExpenseService();

        $fetchedExpense = $service->getExpenseById($expense->id);

        $this->assertNotNull($fetchedExpense);
        $this->assertEquals($expense->id, $fetchedExpense->id);
        $this->assertEquals($expense->description, $fetchedExpense->description);
        $this->assertEquals($expense->date, $fetchedExpense->date);
        $this->assertEquals($expense->user_id, $fetchedExpense->user_id);
        $this->assertEquals($expense->value, $fetchedExpense->value);
    }

    public function testUpdateExpense()
    {
        $user = User::factory()->create();
        $expense = Expense::factory()->create(['user_id' => $user->id]);

        $updatedData = [
            'description' => 'New Description',
            'value' => 200.00,
            'date' => '2024-01-01',
        ];

        $service = new ExpenseService();

        $updatedExpense = $service->updateExpense($updatedData, $expense);

        $this->assertEquals('New Description', $updatedExpense->description);
        $this->assertEquals(200.00, $updatedExpense->value);
        $this->assertEquals('2024-01-01', $updatedExpense->date);
        
    }

    public function testDeleteExpense()
    {
        $user = User::factory()->create();
        $expense = Expense::factory()->create(['user_id' => $user->id]);

        $service = new ExpenseService();

        $service->deleteExpense($expense);

        $this->assertDatabaseMissing('expenses', ['id' => $expense->id]);
    }

}
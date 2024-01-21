<?php

namespace App\Services;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ExpenseService
{
    public function getAllExpenses(int $userId)
    {
        return Expense::where('user_id', $userId)->get();
    }

    public function storeExpense(array $expenseData, int $userId)
    {
        return Expense::create([
            'description' => $expenseData['description'],
            'date' => $expenseData['date'],
            'user_id' => $userId,
            'value' => $expenseData['value'],
        ]);
    }

    public function getExpenseById($id)
    {
        return Expense::find($id);
    }

    public function updateExpense(array $expenseData, Expense $expense)
    {
        $expense->update($expenseData);
        return $expense;
    }

    public function deleteExpense(Expense $expense)
    {
        $expense->delete();
    }
}

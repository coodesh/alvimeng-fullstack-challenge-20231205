<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Services\ExpenseService;
use App\Http\Requests\StoreOrUpdateExpenseRequest;
use App\Http\Resources\ExpenseResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ExpenseCreatedNotification;

class ExpenseController extends Controller
{
    protected $expenseService;

    public function __construct(ExpenseService $expenseService)
    {
        $this->expenseService = $expenseService;
    }

    public function index()
    {
        $userId = Auth::id();
        $expenses = $this->expenseService->getAllExpenses($userId);
        return ExpenseResource::collection($expenses);
    }


    public function store(StoreOrUpdateExpenseRequest $request)
    {    
        $user = Auth::user();
        $expense = $this->expenseService->storeExpense($request->validated(), $user->id);
        
        $user->notify(new ExpenseCreatedNotification($expense));
        return new ExpenseResource($expense);
    }

    public function show(Expense $expense)
    {
        $this->authorize('view', $expense);

        $expense = $this->expenseService->getExpenseById($expense->id);
        return new ExpenseResource($expense);
    }

    public function update(StoreOrUpdateExpenseRequest $request, Expense $expense)
    {
        $this->authorize('update', $expense);

        $updatedExpense = $this->expenseService->updateExpense($request->validated(), $expense);
        return new ExpenseResource($updatedExpense);
    }

    public function destroy(Expense $expense)
    {
        $this->authorize('destroy', $expense);
        
        $this->expenseService->deleteExpense($expense);
        return response()->json(null, 204);
    }

}

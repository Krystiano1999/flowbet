<?php

namespace App\Http\Controllers;

use App\Services\BudgetService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{
    private BudgetService $budgetService;

    public function __construct(BudgetService $budgetService)
    {
        $this->budgetService = $budgetService;
    }

    /**
     * Get a user budget.
     *
     * @return JsonResponse
     */
    public function getBudget(): JsonResponse
    {
        $userId = Auth::id();
        $budget = $this->budgetService->calculateBudget($userId);

        return response()->json([
            'success' => true,
            'budget' => $budget,
        ]);
    }
}

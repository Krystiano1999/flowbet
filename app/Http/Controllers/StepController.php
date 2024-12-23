<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStepRequest;
use App\Services\StepService;
use Illuminate\Http\JsonResponse;
use App\Models\Step;

class StepController extends Controller
{
    private StepService $stepService;

    public function __construct(StepService $stepService)
    {
        $this->stepService = $stepService;
    }

    /**
     * Store a new step.
     *
     * @param StoreStepRequest $request
     * @return JsonResponse
     */
    public function store(StoreStepRequest $request): JsonResponse
    {
        try {
            $step = $this->stepService->createStep($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Krok został dodany pomyślnie!',
                'step' => $step,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Wystąpił błąd podczas dodawania kroku!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Fetch all steps.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $steps = Step::orderBy('step_number')->get();

        return response()->json([
            'success' => true,
            'steps' => $steps,
        ]);
    }

    /**
     * Fetch step numbers and their budgets.
     *
     * @return JsonResponse
     */
    public function getStepNumbersAndBudgets(): JsonResponse
    {
        $steps = Step::select('step_number', 'budget')->orderBy('step_number')->get();

        return response()->json([
            'success' => true,
            'steps' => $steps,
        ]);
    }
}

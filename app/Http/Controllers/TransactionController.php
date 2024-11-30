<?php

namespace App\Http\Controllers;

use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreTransactionRequest;

class TransactionController extends Controller
{
    private TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Get user transactions.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $transactions = $this->transactionService->getUserTransactions(Auth::id());

        return response()->json([
            'success' => true,
            'transactions' => $transactions,
        ]);
    }

    /**
     * Store a new transactions.
     *
     * @param StoreTransactionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreTransactionRequest $request): JsonResponse
    {
        $transaction = $this->transactionService->createTransaction(Auth::id(), $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Transakcja została dodana pomyślnie.',
            'transaction' => $transaction,
        ]);
    }
}

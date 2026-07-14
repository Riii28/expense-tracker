<?php

namespace App\Http\Controllers\Web;

use App\Enums\TransactionType;
use App\Http\Controllers\Controller;
use App\Services\BalanceService;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function __construct(
        protected TransactionService $trxService,
        protected BalanceService $balanceService,
    ) {}

    public function index(Request $request)
    {
        $user = $request->user();

        $balance = $this->balanceService->get($user);
        $transactions = $this->trxService->getAll($user);
        $totalIncome = $this->trxService->getTotal($user, TransactionType::INCOME);
        $totalExpense = $this->trxService->getTotal($user, TransactionType::EXPENSE);

        return view('index', [
            'appTitle' => $this->appTitle,
            'appDescription' => $this->appDescription,
            'balance' => $balance,
            'transactions' => $transactions,
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
        ]);
    }

    public function create()
    {
        return view('create', [
            'appTitle' => $this->appTitle,
            'appDescription' => $this->appDescription,
        ]);
    }

    public function edit(Request $request, string $id)
    {
        $transaction = $this->trxService->get(
            $request->user(),
            $id
        );

        return view('edit', [
            'appTitle' => $this->appTitle,
            'appDescription' => $this->appDescription,
            'transaction' => $transaction,
        ]);
    }
}

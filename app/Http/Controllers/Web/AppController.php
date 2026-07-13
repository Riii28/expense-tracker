<?php

namespace App\Http\Controllers\Web;

use App\Enums\TransactionType;
use App\Http\Controllers\Controller;
use App\Services\BalanceService;
use App\Services\TransactionService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use phpDocumentor\Reflection\Types\This;

class AppController extends Controller
{

    public function __construct(
        public TransactionService $trxService,
        public BalanceService $balanceService
    ) {}

    public function index()
    {
        $balanceId = Auth::user()->balance->id;

        if (empty($balanceId)) abort(404);

        $balance = $this->balanceService->get($balanceId);
        $transactions = $this->trxService->getAll();
        $totalIncome = $this->trxService->getTotal(TransactionType::INCOME);
        $totalExpense = $this->trxService->getTotal(TransactionType::EXPENSE);

        return view('index', [
            'appTitle' => $this->appTitle,
            'appDescription' => $this->appDescription,
            'transactions' => $transactions,
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'balance' => $balance
        ]);
    }

    public function create()
    {
        return view('create', [
            'appTitle' => $this->appTitle,
            'appDescription' => $this->appDescription
        ]);
    }

    public function edit(string $id)
    {
        $balanceId = Auth::user()->balance->id;

        $transaction = $this->trxService->get($id, $balanceId);

        return view('edit', [
            'appTitle' => $this->appTitle,
            'appDescription' => $this->appDescription,
            'id' => $transaction->id,
            'transaction' => $transaction,
        ]);
    }
}

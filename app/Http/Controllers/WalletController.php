<?php

namespace App\Http\Controllers;

use App\Enums\TransactionType;
use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Services\WalletService;
use Illuminate\Http\Request;

class WalletController extends Controller
{

    public function __construct(public readonly WalletService $walletService) {}

    public function redirect(Request $request)
    {
        $wallet = $request->user()->wallets->first();
        return redirect()->route('wallet.show', $wallet);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Wallet $wallet)
    {
        abort_unless($wallet->user_id === $request->user()->id, 404);

        return view('index', [
            'appTitle' => $this->appTitle,
            'appDescription' => $this->appDescription,

            'wallet' => $wallet,
            'wallets' => $request->user()->wallets()->latest()->get(),

            'transactions' => $wallet->transactions()
                ->latest()
                ->paginate(10),

            'totalIncome' => $wallet->transactions()
                ->where('type', TransactionType::INCOME)
                ->sum('amount'),

            'totalExpense' => $wallet->transactions()
                ->where('type', TransactionType::EXPENSE)
                ->sum('amount'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, Wallet $wallet)
    {
        abort_unless($wallet->user_id === $request->user()->id, 404);

        return view('create', [
            'appTitle' => $this->appTitle,
            'appDescription' => $this->appDescription,
            'wallet' => $wallet,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionRequest $request, Wallet $wallet)
    {
        abort_unless($wallet->user_id === $request->user()->id, 404);

        $data = $request->validated();
        $this->walletService->storeTransaction($wallet, $data);

        return redirect()->route('wallet.show', $wallet);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Wallet $wallet, Transaction $transaction)
    {
        abort_unless($wallet->user_id === $request->user()->id && $transaction->wallet_id === $wallet->id, 404);

        return view('edit', [
            'appTitle' => $this->appTitle,
            'appDescription' => $this->appDescription,
            'wallet' => $wallet,
            'transaction' => $transaction,
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionRequest $request, Wallet $wallet, Transaction $transaction)
    {
        abort_unless($wallet->user_id === $request->user()->id, 404);

        $data = $request->validated();
        $this->walletService->updateTransaction($wallet, $transaction, $data);
        return redirect()->route('wallet.show', $wallet);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Wallet $wallet, Transaction $transaction)
    {
        abort_unless($wallet->user_id === $request->user()->id, 404);
        $this->walletService->deleteTransaction($wallet, $transaction);
        return redirect()->route('wallet.show', $wallet);
    }
}

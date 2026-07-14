<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(
        protected TransactionService $trxService
    ) {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        $this->trxService->store(
            $request->user(),
            $request->validated()
        );

        return redirect()
            ->route('home')
            ->with('success', 'Transaction added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $transaction = $this->trxService->get($request->user(), $id);

        return response()->json($transaction);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTransactionRequest $request, string $id)
    {
        $this->trxService->update($request->user(), $id, $request->validated());

        return redirect()
            ->route('home')
            ->with('success', 'Transaction edited successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $this->trxService->delete(
            $request->user(),
            $id
        );

        return redirect()
            ->route('home')
            ->with('success', 'Transaction deleted successfully.');
    }
}

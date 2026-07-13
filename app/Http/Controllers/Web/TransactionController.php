<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller
{
    public function __construct(public TransactionService $trxService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        $user = $request->user();

        $this->trxService->store(
            $user->balance->id,
            $request->validated(),
        );

        return redirect()
            ->route('home')
            ->with('success', 'Transaction added successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTransactionRequest $request, string $id)
    {
        $balanceId = $request->user()->balance->id;
        $data = $request->validated();
        $this->trxService->update($id, $balanceId, $data);
        return redirect()
            ->route('home')
            ->with('success', 'Transaction edited successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $balanceId = $request->user()->balance->id;
        $this->trxService->delete($id, $balanceId);

        return redirect()
            ->route('home')
            ->with('success', 'Transaction deleted successfully.');
    }
}

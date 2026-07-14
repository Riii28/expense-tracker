<?php

namespace App\View\Components\Ui;

use App\Enums\TransactionType;
use App\Models\Transaction;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TableRow extends Component
{
    public readonly string $trxTypeClassText;
    public readonly string $trxTypeClassBg;
    public readonly string $trxTypeLabel;
    public readonly string $status;

    /**
     * Create a new component instance.
     */
    public function __construct(public readonly Transaction $transaction)
    {
        [$this->trxTypeLabel, $this->trxTypeClassText, $this->trxTypeClassBg, $this->status] = match ($transaction->type) {
            TransactionType::INCOME => [
                'Income',
                'text-green-700',
                'bg-green-100',
                '+'
            ],
            TransactionType::EXPENSE => [
                'Expense',
                'text-red-700',
                'bg-green-100',
                '-'
            ]
        };
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.table-row');
    }
}

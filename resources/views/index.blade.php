<x-layouts.app class="bg-neutral-100 text-neutral-900">
    <x-slot:app-title>
        {{ $appTitle }}
    </x-slot:app-title>

    <x-slot:app-description>
        {{ $appDescription }}
    </x-slot:app-description>

    <x-ui.header />

    <!-- Summary -->
    <section class="mx-auto mt-8 max-w-5xl px-6 space-y-4">
        <div class="flex items-center justify-between rounded-2xl border border-neutral-200 bg-white p-4 shadow-sm">
            <h4 class="text-sm font-semibold">
                Wallets
            </h4>

            <ul class="flex flex-wrap items-center gap-2">
                @foreach ($wallets as $item)
                <li>
                    <a href="{{ route('wallet.show', ['wallet' => $item]) }}"
                        @class([ 'rounded-lg px-4 py-2 text-sm font-medium transition' , 'bg-neutral-900 text-white'=>
                        $item->is($wallet),
                        'border border-neutral-200 bg-white text-neutral-700 hover:bg-neutral-100' => !
                        $item->is($wallet),
                        ])
                        >
                        Wallet {{ $loop->iteration }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">

            <!-- Income -->
            <div class="rounded-2xl border border-neutral-200 bg-white p-6 shadow-sm">
                <p class="text-sm text-neutral-500">
                    Income
                </p>

                <h2 class="mt-2 text-3xl font-bold text-green-600">
                    Rp {{ number_format($totalIncome, 0, ',', '.') }}
                </h2>
            </div>

            <!-- Expense -->
            <div class="rounded-2xl border border-neutral-200 bg-white p-6 shadow-sm">
                <p class="text-sm text-neutral-500">
                    Expense
                </p>

                <h2 class="mt-2 text-3xl font-bold text-red-600">
                    Rp {{ number_format($totalExpense, 0, ',', '.') }}
                </h2>
            </div>

            <!-- Balance -->
            <div class="rounded-2xl border border-neutral-200 bg-white p-6 shadow-sm">
                <p class="text-sm text-neutral-500">
                    Balance
                </p>

                <h2 class="mt-2 text-3xl font-bold">
                    Rp {{ number_format($wallet->amount, 0, ',', '.') }}
                </h2>
            </div>

        </div>
    </section>

    <!-- Content -->
    <main class="mx-auto my-8 max-w-5xl px-6">
        <section class="overflow-hidden rounded-2xl border border-neutral-200 bg-white shadow-sm">

            <div class="flex items-center justify-between border-b border-neutral-200 px-6 py-4">
                <div>
                    <h2 class="text-lg font-semibold">
                        Recent Transactions
                    </h2>

                    <p class="mt-1 text-sm text-neutral-500">
                        Manage your income and expenses.
                    </p>
                </div>

                <a href="{{ route('transactions.create', ['wallet' => $wallet]) }}"
                    class="rounded-lg bg-neutral-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-neutral-800">
                    New Transaction
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-neutral-200">

                    <thead class="bg-neutral-50">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-neutral-500">
                                Description
                            </th>

                            <th
                                class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-neutral-500">
                                Category
                            </th>

                            <th
                                class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-neutral-500">
                                Type
                            </th>

                            <th
                                class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wide text-neutral-500">
                                Amount
                            </th>

                            <th
                                class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-neutral-500">
                                Date
                            </th>

                            <th
                                class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wide text-neutral-500">
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-neutral-100">
                        @forelse ($transactions as $transaction)
                        <x-ui.table-row :wallet="$wallet" :transaction="$transaction" />
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-neutral-500">
                                No transactions found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            @if ($transactions->hasPages())
            <div class="border-t border-neutral-200 px-6 py-4">
                {{ $transactions->withQueryString()->links() }}
            </div>
            @endif

        </section>
    </main>
</x-layouts.app>
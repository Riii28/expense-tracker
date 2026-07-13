<x-layouts.app class="bg-neutral-100 text-neutral-900">
    <x-slot:app-title>
        {{ $appTitle }}
    </x-slot:app-title>

    <x-slot:app-description>
        {{ $appDescription }}
    </x-slot:app-description>

    <!-- Navigation -->
    <x-ui.header />


    <!-- Summary -->
    <section class="mx-auto mt-8 max-w-5xl px-6">
        <div class="grid gap-4 md:grid-cols-3">

            <div class="rounded-2xl border border-neutral-200 bg-white p-6 shadow-sm">
                <p class="text-sm text-neutral-500">
                    Income
                </p>

                <h2 class="mt-2 text-3xl font-bold text-green-600">
                    Rp {{ number_format($totalIncome, 0, ',', '.') }}

                </h2>
            </div>

            <div class="rounded-2xl border border-neutral-200 bg-white p-6 shadow-sm">
                <p class="text-sm text-neutral-500">
                    Expense
                </p>

                <h2 class="mt-2 text-3xl font-bold text-red-600">
                    Rp {{ number_format($totalExpense, 0, ',', '.') }}
                </h2>
            </div>

            <div class="rounded-2xl border border-neutral-200 bg-white p-6 shadow-sm">
                <p class="text-sm text-neutral-500">
                    Balance
                </p>

                <h2 class="mt-2 text-3xl font-bold">
                    Rp {{ number_format($balance->amount, 0, ',', '.') }}
                </h2>
            </div>

        </div>
    </section>

    <!-- Content -->
    <main class="mx-auto my-8 max-w-5xl px-6">

        <section class="rounded-2xl border border-neutral-200 bg-white shadow-sm">
            <div class="overflow-hidden rounded-2xl border border-neutral-200 bg-white shadow-sm">
                <div class="border-b border-neutral-200 px-6 py-4 flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-semibold">
                            Recent Transactions
                        </h2>

                        <p class="mt-1 text-sm text-neutral-500">
                            Manage your income and expenses.
                        </p>
                    </div>

                    <div>
                        <a href="{{ route('transactions.create') }}"
                            class="rounded-lg bg-neutral-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-neutral-800">
                            New Transaction
                        </a>
                    </div>
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
                            <tr class="hover:bg-neutral-50 transition">
                                <td class="max-w-48 wrap-break-word px-6 py-4 font-medium">
                                    {{ $transaction->description}}
                                </td>

                                <td class="px-6 py-4 text-neutral-600">
                                    {{ $transaction->category}}
                                </td>

                                <td class="px-6 py-4">
                                    <span
                                        class="rounded-full bg-green-100 px-2.5 py-1 text-xs font-medium text-green-700">
                                        {{ $transaction->type}}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-right font-semibold text-green-600">
                                    Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4 text-neutral-500">
                                    {{ $transaction->created_at->format('d M Y') }} </td>

                                <td class="px-6 py-4 text-right space-x-3">
                                    <a href="{{ route('transactions.edit', $transaction->id) }}"
                                        class="text-sm font-medium text-neutral-700 hover:text-black">
                                        Edit
                                    </a>

                                    <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST"
                                        class="inline-flex">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="text-sm font-medium text-red-600 hover:text-red-700">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-neutral-500">
                                    Transaction not available.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

                <div class="flex items-center justify-between border-t border-neutral-200 px-6 py-4">

                    {{ $transactions->withQueryString()->links() }}
                </div>

            </div>
        </section>

    </main>
</x-layouts.app>
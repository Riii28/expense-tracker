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
                    Rp10.000.000
                </h2>
            </div>

            <div class="rounded-2xl border border-neutral-200 bg-white p-6 shadow-sm">
                <p class="text-sm text-neutral-500">
                    Expense
                </p>

                <h2 class="mt-2 text-3xl font-bold text-red-600">
                    Rp10.000.000
                </h2>
            </div>

            <div class="rounded-2xl border border-neutral-200 bg-white p-6 shadow-sm">
                <p class="text-sm text-neutral-500">
                    Balance
                </p>

                <h2 class="mt-2 text-3xl font-bold">
                    Rp10.000.000
                </h2>
            </div>

        </div>
    </section>

    <!-- Content -->
    <main class="mx-auto my-8 max-w-5xl px-6">

        <section class="rounded-2xl border border-neutral-200 bg-white shadow-sm">
            <div class="overflow-hidden rounded-2xl border border-neutral-200 bg-white shadow-sm">

                <div class="border-b border-neutral-200 px-6 py-4">
                    <h2 class="text-lg font-semibold">
                        Recent Transactions
                    </h2>

                    <p class="mt-1 text-sm text-neutral-500">
                        Manage your income and expenses.
                    </p>
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

                            <tr class="hover:bg-neutral-50 transition">
                                <td class="max-w-48 wrap-break-word px-6 py-4 font-medium">
                                    Salary
                                </td>

                                <td class="px-6 py-4 text-neutral-600">
                                    Work
                                </td>

                                <td class="px-6 py-4">
                                    <span
                                        class="rounded-full bg-green-100 px-2.5 py-1 text-xs font-medium text-green-700">
                                        Income
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-right font-semibold text-green-600">
                                    +Rp10.000.000
                                </td>

                                <td class="px-6 py-4 text-neutral-500">
                                    12 Jul 2026
                                </td>

                                <td class="px-6 py-4 text-right space-x-3">
                                    <a href="#" class="text-sm font-medium text-neutral-700 hover:text-black">
                                        Edit
                                    </a>

                                    <a href="#" class="text-sm font-medium text-red-600 hover:text-red-700">
                                        Delete
                                    </a>
                                </td>
                            </tr>

                            <tr class="hover:bg-neutral-50 transition">
                                <td class="px-6 py-4 font-medium">
                                    Dinner
                                </td>

                                <td class="px-6 py-4 text-neutral-600">
                                    Food
                                </td>

                                <td class="px-6 py-4">
                                    <span class="rounded-full bg-red-100 px-2.5 py-1 text-xs font-medium text-red-700">
                                        Expense
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-right font-semibold text-red-600">
                                    -Rp150.000
                                </td>

                                <td class="px-6 py-4 text-neutral-500">
                                    11 Jul 2026
                                </td>

                                <td class="px-6 py-4 text-right space-x-3">
                                    <a href="#" class="text-sm font-medium text-neutral-700 hover:text-black">
                                        Edit
                                    </a>

                                    <a href="#" class="text-sm font-medium text-red-600 hover:text-red-700">
                                        Delete
                                    </a>
                                </td>
                            </tr>

                        </tbody>

                    </table>
                </div>

                <div class="flex items-center justify-between border-t border-neutral-200 px-6 py-4">

                    <p class="text-sm text-neutral-500">
                        Showing <span class="font-medium text-neutral-900">1–10</span> of
                        <span class="font-medium text-neutral-900">32</span> transactions
                    </p>

                    {{-- {{ $transactions->links() }} --}}

                </div>

            </div>
        </section>

    </main>
</x-layouts.app>
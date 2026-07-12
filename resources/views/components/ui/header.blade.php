<header class="sticky top-0 z-50 border-b border-neutral-200 bg-white/90 backdrop-blur">
    <div class="mx-auto flex max-w-5xl items-center justify-between px-6 py-4">
        <a href="{{ route('home') }}" class="text-xl font-bold tracking-tight">
            Expense Tracker
        </a>

        <nav class="flex items-center gap-2">
            <a href="{{ route('home') }}"
                class="rounded-lg px-4 py-2 text-sm font-medium transition hover:bg-neutral-100">
                Home
            </a>

            <a href="{{ route('transactions.create') }}"
                class="rounded-lg bg-neutral-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-neutral-800">
                Add Transaction
            </a>
        </nav>
    </div>
</header>
<x-layouts.app class="bg-neutral-100 text-neutral-900">
    <x-slot:app-title>
        {{ $appTitle }}
    </x-slot:app-title>

    <x-slot:app-description>
        {{ $appDescription }}
    </x-slot:app-description>

    <main class="mx-auto my-8 flex max-w-md px-6">
        <section class="w-full rounded-2xl border border-neutral-200 bg-white p-8 shadow-sm">
            <header class="mb-8">
                <h1 class="text-2xl font-bold">Login</h1>
                <p class="mt-2 text-sm text-neutral-600">
                    Masuk menggunakan email dan password.
                </p>
            </header>

            @if ($errors->any())
            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-3 text-sm text-red-700">
                {{ $errors->first() }}
            </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf

                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium">
                        Email
                    </label>

                    <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="you@example.com"
                        autocomplete="email" autofocus required
                        aria-invalid="@error('email') true @else false @enderror"
                        class="w-full rounded-lg border border-neutral-300 px-4 py-2.5 transition focus:border-neutral-900 focus:outline-none focus:ring-2 focus:ring-neutral-200">

                    @error('email')
                    <p class="text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium">
                        Password
                    </label>

                    <input id="password" name="password" type="password" placeholder="••••••••"
                        autocomplete="current-password" required
                        aria-invalid="@error('password') true @else false @enderror"
                        class="w-full rounded-lg border border-neutral-300 px-4 py-2.5 transition focus:border-neutral-900 focus:outline-none focus:ring-2 focus:ring-neutral-200">

                    @error('password')
                    <p class="text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full rounded-lg bg-neutral-900 px-4 py-2.5 font-medium text-white transition hover:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-neutral-400">
                    Login
                </button>
            </form>
        </section>
    </main>
</x-layouts.app>
<x-layouts.app class="space-y-6 text-neutral-900">
    <x-slot:app-title>
        {{ $appTitle }}
    </x-slot:app-title>

    <header class="bg-neutral-200 fixed w-full">
        <div class="max-w-6xl mx-auto px-4 py-6">
            <h1 class="text-4xl font-bold">{{ $appTitle }}</h1>
            <p>Simple task management</p>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 py-6 space-y-6 pt-34">
        <ul class="space-y-4">
            @forelse ($tasks as $task)
                <li class="rounded-xl bg-neutral-100 p-4">
                    <h2 class="text-2xl font-bold">
                        {{ $task->title }}
                    </h2>

                    <p class="mt-2 text-neutral-600">
                        {{ $task->description }}
                    </p>
                </li>
            @empty
                <li class="rounded-xl bg-neutral-100 p-6 text-center text-neutral-500">
                    Belum ada task.
                </li>
            @endforelse
        </ul>
        {{ $tasks->withQueryString()->links() }}
    </main>
</x-layouts.app>
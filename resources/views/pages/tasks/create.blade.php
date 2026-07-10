<x-layouts.app class="space-y-6 text-neutral-900">
    <x-slot:app-title>
        {{ $appTitle }}
    </x-slot:app-title>
    
    <header class="bg-neutral-200 fixed w-full">
        <div class="max-w-6xl mx-auto px-4 py-6">
            <h1 class="text-4xl font-bold">{{ $appTitle }}</h1>
            <p>Create new task</p>
        </div>
    </header>
    <main class="max-w-6xl mx-auto px-4 py-6 space-y-6 pt-34">
        @if (session('task-created'))
            <div style="color: green;">
                {{ session('task-created') }}
            </div>
        @endif

        <form action="{{ url('/create-task') }}" method="post">
            @csrf

            <input name="title" type="text" placeholder="Your task title" required>
            <button type="submit">Create</button>
        </form>
    </main>

</x-layouts.app>
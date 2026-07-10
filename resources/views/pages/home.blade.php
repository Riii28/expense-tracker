<x-layouts.app class="mx-auto">
    <x-slot:app-title>
        {{$appTitle}}
    </x-slot>

    <div x-data="{ open: false }">
    <button @click="open = !open">
        Toggle
    </button>

    <div x-show="open">
        Halo Alpine!
    </div>

    <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/about">about</a></li>
    </ul>
</div>
</x-layouts.app>
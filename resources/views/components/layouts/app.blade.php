<x-layouts.app.header :title="$title ?? null">
    <flux:main class="max-w-4xl mx-auto">
        {{ $slot }}
    </flux:main>
</x-layouts.app.header>

@props(['title' => false])

<div {{ $attributes->class('bg-white rounded-lg shadow-md p-4 flex flex-col
        items-start relative') }}>
    @if($title)
        <h2 class="text-lg font-semibold mb-2 text-center w-full">{{ $title }}</h2>
    @endif
    <div class="w-full">
    {{ $slot }}
    </div>
</div>

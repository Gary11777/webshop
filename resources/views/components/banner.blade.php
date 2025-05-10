<div
    x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 3000)"
    x-show="show"
    class="alert transition ease-in-out
    duration-500 p-4 rounded text-white
    bg-green-500">
    {{ $slot }}
</div>

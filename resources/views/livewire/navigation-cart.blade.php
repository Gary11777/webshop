<flux:navbar.item :href="route('home')"
                  :current="request()->routeIs('home')"
                  wire:navigate>
    {{ __('Your cart') }} ({{ $this->count }})
</flux:navbar.item>

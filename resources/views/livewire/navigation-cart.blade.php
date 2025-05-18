<flux:navbar.item :href="route('cart')"
                  :current="request()->routeIs('cart')"
                  wire:navigate>
    {{ __('Your cart') }} ({{ $this->count }})
</flux:navbar.item>

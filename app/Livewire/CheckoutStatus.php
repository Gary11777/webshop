<?php

namespace App\Livewire;

use Livewire\Component;

class CheckoutStatus extends Component
{
    public $sessionId;

    public function mount()
    {
        $this->sessionId = request()->get('session_id');
    }

    public function getOrderProperty()
    {
        return auth()->user()->orders()
            ->where('stripe_checkout_session_id', $this->sessionId)
            ->first();
    }
    public function render()
    {
        return view('livewire.checkout-status');
    }
}

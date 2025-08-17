<?php

namespace App\Livewire;

use App\Actions\Webshop\HandleCheckoutSessionCompleted;
use Laravel\Cashier\Cashier;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class CheckoutStatus extends Component
{
    public $sessionId;
    public $paymentStatus = 'processing'; // processing, completed, failed
    public $errorMessage = null;

    public function mount()
    {
        $this->sessionId = request()->get('session_id');
        
        if (!$this->sessionId) {
            $this->paymentStatus = 'failed';
            $this->errorMessage = 'Invalid session ID';
            return;
        }

        // Try to process the session immediately if order doesn't exist
        $this->processSessionIfNeeded();
    }

    public function processSessionIfNeeded()
    {
        try {
            // First retrieve the session from Stripe
            $session = Cashier::stripe()->checkout->sessions->retrieve($this->sessionId);
            
            // Check if order already exists (using session metadata or direct search)
            $existingOrder = \App\Models\Order::where('stripe_checkout_session_id', $this->sessionId)->first();
            
            if ($existingOrder) {
                $this->paymentStatus = 'completed';
                return;
            }

            // If user is authenticated, also check their orders
            if (auth()->check()) {
                $userOrder = auth()->user()->orders()
                    ->where('stripe_checkout_session_id', $this->sessionId)
                    ->first();
                    
                if ($userOrder) {
                    $this->paymentStatus = 'completed';
                    return;
                }
            }
            
            if ($session->payment_status === 'paid') {
                // Process the session immediately
                (new HandleCheckoutSessionCompleted)->handle($this->sessionId);
                $this->paymentStatus = 'completed';
            } elseif ($session->payment_status === 'unpaid') {
                $this->paymentStatus = 'failed';
                $this->errorMessage = 'Payment was not completed';
            } else {
                // Still processing
                $this->paymentStatus = 'processing';
            }
        } catch (\Exception $e) {
            Log::error('Error processing checkout session: ' . $e->getMessage() . ' Stack: ' . $e->getTraceAsString());
            $this->paymentStatus = 'failed';
            $this->errorMessage = 'Unable to verify payment status. Error: ' . $e->getMessage();
        }
    }

    public function checkStatus()
    {
        // Manual refresh method that can be called via polling
        $this->processSessionIfNeeded();
    }

    public function getOrderProperty()
    {
        if ($this->paymentStatus === 'completed') {
            // First try to get order directly
            $order = \App\Models\Order::where('stripe_checkout_session_id', $this->sessionId)->first();
            
            // If user is authenticated and no order found, check user's orders
            if (!$order && auth()->check()) {
                $order = auth()->user()->orders()
                    ->where('stripe_checkout_session_id', $this->sessionId)
                    ->first();
            }
            
            return $order;
        }
        return null;
    }

    public function render()
    {
        return view('livewire.checkout-status');
    }
}

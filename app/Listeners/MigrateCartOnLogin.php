<?php

namespace App\Listeners;

use App\Actions\Webshop\MigrateSessionCart;
use App\Models\Cart;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Log;

class MigrateCartOnLogin
{
    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        Log::info('MigrateCartOnLogin: Starting cart migration', [
            'user_id' => $event->user->id,
            'current_session_id' => session()->getId()
        ]);
        
        // Try to get the previous session ID stored before session regeneration
        $previousSessionId = session()->get('previous_session_id');
        
        Log::info('MigrateCartOnLogin: Previous session ID', [
            'previous_session_id' => $previousSessionId
        ]);
        
        $sessionCart = null;
        
        if ($previousSessionId) {
            $sessionCart = Cart::where('session_id', $previousSessionId)->first();
            Log::info('MigrateCartOnLogin: Found cart with previous session ID', [
                'cart_found' => $sessionCart ? 'yes' : 'no',
                'cart_id' => $sessionCart?->id
            ]);
            
            // Clean up the temporary session ID
            session()->forget('previous_session_id');
        } else {
            // Fallback: try current session ID (in case session wasn't regenerated)
            $sessionCart = Cart::where('session_id', session()->getId())->first();
            Log::info('MigrateCartOnLogin: Trying current session ID', [
                'cart_found' => $sessionCart ? 'yes' : 'no',
                'cart_id' => $sessionCart?->id
            ]);
        }
        
        // Also check all session carts to debug
        $allSessionCarts = Cart::whereNull('user_id')->get();
        Log::info('MigrateCartOnLogin: All session carts', [
            'count' => $allSessionCarts->count(),
            'session_ids' => $allSessionCarts->pluck('session_id')->toArray()
        ]);
        
        // Migrate session cart to user cart if session cart exists and has items
        if ($sessionCart && $sessionCart->items()->exists()) {
            $user = $event->user;
            $userCart = $user->cart ?: $user->cart()->create();
            
            Log::info('MigrateCartOnLogin: Migrating cart', [
                'session_cart_id' => $sessionCart->id,
                'user_cart_id' => $userCart->id,
                'items_count' => $sessionCart->items()->count()
            ]);
            
            (new MigrateSessionCart)->migrate($sessionCart, $userCart);
            
            Log::info('MigrateCartOnLogin: Migration completed');
        } else {
            Log::info('MigrateCartOnLogin: No cart to migrate', [
                'cart_exists' => $sessionCart ? 'yes' : 'no',
                'has_items' => $sessionCart?->items()->exists() ? 'yes' : 'no'
            ]);
        }
    }
}

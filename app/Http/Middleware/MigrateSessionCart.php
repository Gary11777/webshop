<?php

namespace App\Http\Middleware;

use App\Actions\Webshop\MigrateSessionCart as MigrateSessionCartAction;
use App\Models\Cart;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class MigrateSessionCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only run for authenticated users who don't have a migrated flag
        if (auth()->check() && !session()->has('cart_migrated')) {
            $user = auth()->user();
            
            Log::info('MigrateSessionCart Middleware: Checking for session cart', [
                'user_id' => $user->id,
                'session_id' => session()->getId()
            ]);
            
            // Check if we have a stored cart ID in the session
            $sessionCartId = session()->get('guest_cart_id');
            
            if ($sessionCartId) {
                $sessionCart = Cart::find($sessionCartId);
                Log::info('MigrateSessionCart Middleware: Found cart by stored ID', [
                    'cart_id' => $sessionCartId,
                    'cart_found' => $sessionCart ? 'yes' : 'no'
                ]);
            } else {
                // Try to find any session cart that doesn't belong to a user
                // We'll check for carts created in the last 24 hours to avoid old abandoned carts
                $sessionCart = Cart::whereNull('user_id')
                    ->where('created_at', '>=', now()->subDay())
                    ->orderBy('created_at', 'desc')
                    ->first();
                    
                Log::info('MigrateSessionCart Middleware: Searching for recent session cart', [
                    'cart_found' => $sessionCart ? 'yes' : 'no',
                    'cart_id' => $sessionCart?->id
                ]);
            }
            
            if ($sessionCart && $sessionCart->items()->exists()) {
                Log::info('MigrateSessionCart Middleware: Found session cart to migrate', [
                    'session_cart_id' => $sessionCart->id,
                    'session_cart_session_id' => $sessionCart->session_id,
                    'items_count' => $sessionCart->items()->count()
                ]);
                
                // Get or create user cart
                $userCart = $user->cart ?: $user->cart()->create();
                
                // Migrate the cart
                (new MigrateSessionCartAction)->migrate($sessionCart, $userCart);
                
                Log::info('MigrateSessionCart Middleware: Migration completed', [
                    'user_cart_id' => $userCart->id
                ]);
                
                // Clean up session data
                session()->forget('guest_cart_id');
                session()->put('cart_migrated', true);
            } else {
                Log::info('MigrateSessionCart Middleware: No session cart to migrate');
                // Still set the flag to avoid checking repeatedly
                session()->forget('guest_cart_id');
                session()->put('cart_migrated', true);
            }
        }
        
        return $next($request);
    }
}

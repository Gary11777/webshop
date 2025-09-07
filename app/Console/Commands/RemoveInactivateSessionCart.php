<?php

namespace App\Console\Commands;

use App\Models\Cart;
use Illuminate\Console\Command;

class RemoveInactivateSessionCart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:remove-inactivate-session-cart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove inactive session carts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //  Remove inactive session carts
        $carts = Cart::whereDoesntHave('user')
        ->whereDate('created_at', '<', now()->subDays(1))->get();

        foreach ($carts as $cart) {
            $cart->items()->delete();
            $cart->delete();
        }
    }
}

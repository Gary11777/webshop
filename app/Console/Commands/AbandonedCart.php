<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cart;
use Illuminate\Support\Facades\Mail;
use App\Mail\AbandonedCartReminder;

class AbandonedCart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:abandoned-cart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Look for abandoned carts and notify their owner';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $carts = Cart::withWhereHas('user')
            ->whereDate('updated_at', today()->subDays())
            ->get();

        $this->info("Found {$carts->count()} abandoned carts from yesterday.");

        foreach ($carts as $cart) {
            Mail::to($cart->user->email)->send(new AbandonedCartReminder($cart));
        }

        // Here you could add logic to notify users about their abandoned carts
        // For example: send emails, SMS, or other notifications

        return 0; // Success exit code
    }
}

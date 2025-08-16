<?php

namespace App\Livewire\Auth;

use App\Actions\Webshop\MigrateSessionCart;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        // Store the current session ID before authentication
        $previousSessionId = session()->getId();
        
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        // Store the previous session ID before login
        session()->put('previous_session_id', $previousSessionId);
        
        Auth::login($user);
        
        // The cart migration will be handled by the MigrateCartOnLogin listener

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}

<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\Client\AccountActivationNotification;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredClientController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('client.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'manager_name' => ['required', 'string', 'max:255'],
            'manager_department' => ['required', 'string', 'max:255'],
            'manager_phone_number' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Client::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $client = Client::create([
            'name' => $request->name,
            'manager_name' => $request->manager_name,
            'manager_department' => $request->manager_department,
            'manager_phone_number' => $request->manager_phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verification_token' => Str::random(32),
            'is_active' => false, // 仮登録状態に設定
        ]);

        $client->notify(new AccountActivationNotification($client));

        return redirect()->route('client.registration.success');
    }
}

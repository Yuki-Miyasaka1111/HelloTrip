<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;

class ClientActivationController extends Controller
{
    public function activate($token)
    {
        $client = Client::where('email_verification_token', $token)->first();

        if (!$client) {
            return redirect()->route('client.activation.failed');
        }

        $client->is_active = true;
        $client->email_verification_token = null;
        $client->save();

        return redirect()->route('client.activation.success');
    }
}

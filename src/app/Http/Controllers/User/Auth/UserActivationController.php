<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserActivationController extends Controller
{
    public function activate($token)
    {
        $user = User::where('email_verification_token', $token)->first();

        if (!$user) {
            return redirect()->route('user.activation.failed');
        }

        $user->is_active = true;
        $user->email_verification_token = null;
        $user->save();

        return redirect()->route('user.activation.success');
    }
}

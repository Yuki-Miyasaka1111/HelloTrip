<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect clients after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::CLIENT_HOME;

    /**
     * Get the password reset validation rules.
     *
     * @return string
     */
    protected function validationErrorBag()
    {
        return 'client';
    }

    protected function broker()
    {
        return Password::broker('clients'); // clients は password_resets テーブルの設定名です
    }

    protected function guard()
    {
        return Auth::guard('client'); // client は設定ファイル auth.php で定義したガード名です
    }

    // showResetFormメソッドをオーバーライド
    public function showResetForm(Request $request, $token = null)
    {
        return view('client.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Reset the given client's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        return $this->reset($request);
    }
}

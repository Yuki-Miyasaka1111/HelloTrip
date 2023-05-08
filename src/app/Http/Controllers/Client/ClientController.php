<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Client;

class ClientController extends Controller
{
    public function create()
    {
        return view('client.create');
    }

    public function store(Request $request)
    {
        // バリデーションの実行
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // クライアントの登録
        $client = Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // ログイン
        Auth::login($client);

        // ホーム画面にリダイレクト
        return redirect('/');
    }
}

@extends('layouts.user')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="text-left">
                <h2 style="font-size:1rem;">トップページ</h2>
                @if(Auth::check())
                    <h3>ユーザー名: {{ $user_name }}</h3>
                @else
                    <h3>ユーザー名: 未ログイン</h3>
                @endif

                @if(Auth::guard('client')->check())
                    <h3>クライアントユーザー名: {{ $client_name }}</h3>
                @else
                    <h3>クライアントユーザー名: 未ログイン</h3>
                @endif
            </div>
            <div class="text-right">
            <a class="btn btn-success" href="/">新規登録</a>
            @if(Auth::check())
                <p>ログインユーザー名: {{ Auth::user()->name }}</p>
                <form method="POST" action="{{ route('user.logout') }}">
                    @csrf
                    <button class="btn btn-success" type="submit">ログアウト</button>
                </form>
            @endif
            </div>
        </div>
    </div>
 
    <table class="table table-bordered">
        <tr>
            <th style="text-align:right">No</th>
            <th style="text-align:right">ホテル名</th>
            <th style="text-align:right">価格</th>
            <th style="text-align:right">カテゴリ</th>
            <th style="text-align:right">地域</th>
        </tr>
        @foreach ($hotels as $hotel)
        <tr>
            <td style="text-align:right">{{ $hotel->id }}</td>
            <td style="text-align:right"><a href="/">{{ $hotel->name }}</a></td>
            <td style="text-align:right">{{ $hotel->price }}円</td>
            <td style="text-align:right"></td>
            <td style="text-align:right"></td>
        </tr>
        @endforeach
    </table>

    {!! $hotels->links('pagination::bootstrap-5') !!}

@endsection
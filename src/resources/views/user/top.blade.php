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
                <form method="POST" action="{{ route('user.logout') }}">
                    @csrf
                    <button class="btn btn-success" type="submit">ログアウト</button>
                </form>
            </div>
        </div>
    </div>
 
    <!-- どのホテルを表示させるか検討 -->
    <section class="top-hotelSlider">
        @foreach ($publishedHotels as $publishedHotel)
            <a href="{{ route('hotel.index', $publishedHotel->id) }}" class="d-block width-3">
                @if(isset($publishedHotel->images) && count($publishedHotel->images) > 0)
                    @foreach($publishedHotel->images as $image)
                        <img src="{{ asset('storage/' . $image->path) }}" class="width-full">
                    @endforeach
                @else
                    <p>画像なし</p>
                @endif
                <b>{{ $publishedHotel->name }}</b>
                <p>{{ $publishedHotel->address_1 }}{{ $publishedHotel->address_2 }}</p>
                <div class="d-flex justify-between itmes-center">
                    <p>{{ $publishedHotel->catch_copy }}</p>
                    <p>{{ number_format($publishedHotel->minimum_price) }}円〜</p>
                </div>
            </a>
        @endforeach
    </section>

        <!-- どのキャンペーンを表示させるか検討 -->
        <section class="top-hotelSlider">
        @foreach ($publishedCampaigns as $publishedCampaign)
            <a class="d-block width-3">
                @if(isset($publishedCampaign->image_url))
                    <img src="{{ asset('storage/' . $publishedCampaign->image_url) }}" class="width-full">
                @else
                    <p>画像なし</p>
                @endif
                <b>{{ $publishedCampaign->title }}</b>
            </a>
        @endforeach
    </section>

    <!-- どのホテルを表示させるか検討 -->
    <h2>PICK UP</h2>
    <section class="top-pickupHotel">
        @foreach ($publishedHotels as $publishedHotel)
            @if ($loop->index == 3)
            <a class="d-block width-3">
                @foreach($publishedHotel->images as $image)
                    <img src="{{ asset('storage/' . $image->path) }}" class="width-full">
                @endforeach
                <b>{{ $publishedHotel->name }}</b>
                <p>{{ $publishedHotel->address_1 }}{{ $publishedHotel->address_2 }}</p>
                <div class="d-flex justify-between itmes-center">
                    <p>{{ $publishedHotel->catch_copy }}</p>
                    <p>{{ number_format($publishedHotel->minimum_price) }}円〜</p>
                </div>
            </a>
            @endif
        @endforeach
    </section>


@endsection
@extends(auth()->check() ? 'layouts.user' : 'layouts.guest')

@section('content')
    <section class="bg-tertiary">
        <div class="category-bar py-1 px-1 flex justify-between items-center">
            @foreach($categories as $index => $category)
            <a href="{{ $category->slug }}">
                <img src="{{ asset('assets/img/icons/c-navigation_categoryBar'. sprintf('%02d', $index+1) .'.svg') }}" alt="">
                <p>{{ $category->name }}</p>
            </a>
            @endforeach
        </div>
    </section>

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
    <section class="swiper top-hotelSlider">
        <div class="swiper-wrapper">
            @foreach ($publishedHotels as $publishedHotel)
                <div class="swiper-slide">
                    <a href="{{ route('hotel.index', $publishedHotel->id) }}" class="d-block width-full">
                        @if(isset($publishedHotel->images) && count($publishedHotel->images) > 0)
                            <div class="swiper swiper2">
                                <div class="swiper-wrapper">
                                    @foreach($publishedHotel->images as $image)
                                        <div class="swiper-slide"><img src="{{ asset('storage/' . $image->path) }}" class="width-full"></div>
                                    @endforeach
                                </div>
                            </div>
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
                </div>
            @endforeach
        </div>
    
        <!-- ページネーション -->
        <div class="swiper-pagination"></div>
    
        <!-- 前へ次へ矢印ナビゲーション -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    
        <!-- スクロールバー -->
        <div class="swiper-scrollbar"></div>
    </section>

    <!-- どのキャンペーンを表示させるか検討 -->
    {{-- <section class="top-hotelSlider">
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
    </section> --}}

    <!-- どのホテルを表示させるか検討 -->
    {{-- <h2>PICK UP</h2>
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
    </section> --}}


@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        const swiper1 = new Swiper('.top-hotelSlider', {
            autoplay: {
                delay: 5000,
                disableOnInteraction: false
            },
            centeredSlides: true,
            slidesPerView: 3,
            loop: true,
            //ページネーション
            pagination: {
                el: '.swiper-pagination',
            },
            //次へ前へ矢印ナビゲーション
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            //スクロールバーを表示
            scrollbar: {
                el: '.swiper-scrollbar',
            },
        });

        $('.swiper2').each(function() {
            const swiper2 = new Swiper(this, {
                slidesPerView: 1,
                nested: true
            });
        });

        if (location.hash !== '') $('a[href="' + location.hash + '"]').tab('show');
        return $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            return location.hash = $(e.target).attr('href').substr(1);
        });
    });
</script>
@endsection
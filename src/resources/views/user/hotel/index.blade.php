@extends(auth()->check() ? 'layouts.user' : 'layouts.guest')

@section('content')
    <x-user.partials.card-wrapper class="l-container">
        <x-user.partials.card-wrapper class="l-content">
            <x-user.partials.article-wrapper class="p-hotelDetail">
                <b>{{ $publishedHotel->name }}</b>
                <p>{{ $publishedHotel->address_1 }}{{ $publishedHotel->address_2 }}</p>
                @if(isset($publishedHotel->images) && count($publishedHotel->images) > 0)
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            @foreach($publishedHotel->images as $image)
                                <div class="swiper-slide"><img src="{{ asset('storage/' . $image->path) }}" class="width-full"></div>
                            @endforeach
                        </div>
                        
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                @else
                    <p>画像なし</p>
                @endif
                <div class="d-flex justify-between itmes-center">
                    <p>{{ $publishedHotel->catch_copy }}</p>
                    <p>{{ number_format($publishedHotel->minimum_price) }}円〜</p>
                </div>
            </x-user.partials.article-wrapper>
        </x-user.partials.card-wrapper>
    </x-user.partials.card-wrapper>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        const swiper = new Swiper('.swiper', {
            autoplay: {
                delay: 5000,
                disableOnInteraction: false
            },
            slidesPerView: 1,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    });
</script>
@endsection
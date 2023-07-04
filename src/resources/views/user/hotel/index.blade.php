@extends(auth()->check() ? 'layouts.user' : 'layouts.guest')

@section('content')
    <x-user.partials.card-wrapper class="l-container">
        <x-user.partials.card-wrapper class="l-content">
            <x-user.partials.article-wrapper class="p-hotelDetail">

                <section class="p-hotelDetail__fv">
                    @if(isset($publishedHotel->publishedImages) && count($publishedHotel->publishedImages) > 0)
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                @foreach($publishedHotel->publishedImages as $image)
                                    <div class="swiper-slide"><img src="{{ asset('storage/' . $image->path) }}" class="width-full"></div>
                                @endforeach
                            </div>
                            
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-pagination"></div>
                        </div>
                    @else
                        <img src="{{ asset('assets/img/user/no-image.png') }}" id="default-image">
                    @endif
                    <div class="p-hotelDetail__tags d-flex items-center mt-1">
                        <p class="p-hotelDetail__address d-flex items-center mr-2"><span class="d-block mr-0-2-5"><img src="{{ asset('assets/img/user/icons/hotel_post_address_icon.svg') }}" class="width-full"></span>{{ $publishedHotel->address_1 }}{{ $publishedHotel->address_2 }}</p>
                        <p class="p-hotelDetail__category d-flex items-center"><span class="d-block mr-0-2-5"><img src="{{ asset('assets/img/user/icons/hotel_post_category_icon.svg') }}" class="width-full"></span>{{ $publishedHotel->category->name }}</p>
                    </div>
                    <h2 class="mt-1">{{ $publishedHotel->name }}</h2>
                    <p class="p-hotelDetail__catch-copy mt-0-5">{{ $publishedHotel->catch_copy }}</p>
                    <b class="p-hotelDetail__minimum-price d-block mt-0-5">￥{{ number_format($publishedHotel->minimum_price) }} / 人（税込み）～</b>
                    <p class="p-hotelDetail__concept mt-1">{{ $publishedHotel->concept }}</p>
                </section>

                <section class="p-hotelDetail__specInfo mt-2">
                    <h4 class="mb-0-7-5">設備</h4>
                    <ul class="p-hotelSpecList">
                        @foreach($facilities as $facility)
                            <li class="p-hotelSpecList_list">
                                <span class="p-hotelSpecList_key">{{ $facility->name }}</span>
                                <span class="p-hotelSpecList_value">{{ $publishedHotel->publishedFacilities->contains('id', $facility->id) ? '○' : '-' }}</span>
                            </li>
                        @endforeach
                    </ul>
                </section>

                <section class="p-hotelDetail__specInfo mt-2">
                    <h4 class="mb-0-7-5">アメニティ</h4>
                    <ul class="p-hotelSpecList">
                        @foreach($amenities as $amenity)
                            <li class="p-hotelSpecList_list">
                                <span class="p-hotelSpecList_key">{{ $amenity->name }}</span>
                                <span class="p-hotelSpecList_value">{{ $publishedHotel->publishedAmenities->contains('id', $amenity->id) ? '○' : '-' }}</span>
                            </li>
                        @endforeach
                    </ul>
                </section>

                <section class="p-hotelDetail__basicInfo">
                    <h3 class="mb-1-5">基本情報</h3>
                    <table class="article-table">
                        <tbody>
                            @if(isset($publishedHotel->name))
                            <tr>
                                <th class="article-table_th">宿泊施設名</th>
                                <td class="article-table_td">{{ $publishedHotel->name }}</td>
                            </tr>
                            @endif
                            @if(isset($publishedHotel->hotelScale))
                            <tr>
                                <th class="article-table_th">宿泊施設規模</th>
                                <td class="article-table_td">{{ $publishedHotel->hotelScale->name }}</td>
                            </tr>
                            @endif
                            @if(isset($publishedHotel->category))
                            <tr>
                                <th class="article-table_th">宿泊カテゴリ</th>
                                <td class="article-table_td">{{ $publishedHotel->category->name }}</td>
                            </tr>
                            @endif
                            @if(isset($publishedHotel->prefecture))
                            <tr>
                                <th class="article-table_th">都道府県</th>
                                <td class="article-table_td">{{ $publishedHotel->prefecture->name }}</td>
                            </tr>
                            @endif
                            @if(isset($publishedHotel->address_1))
                            <tr>
                                <th class="article-table_th">住所</th>
                                <td class="article-table_td">
                                    {{ $publishedHotel->address_1 }}
                                    @if(isset($publishedHotel->address_2))
                                        {{ $publishedHotel->address_2 }}
                                    @endif
                                    @if(isset($publishedHotel->address_3))
                                        {{ $publishedHotel->address_3 }}
                                    @endif
                                </td>
                            </tr>
                            @endif
                            @if(isset($publishedHotel->access))
                            <tr>
                                <th class="article-table_th">アクセス</th>
                                <td class="article-table_td">{{ $publishedHotel->access }}</td>
                            </tr>
                            @endif
                            @if(isset($publishedHotel->parking_information))
                            <tr>
                                <th class="article-table_th">駐車場</th>
                                <td class="article-table_td">{{ $publishedHotel->parking_information }}</td>
                            </tr>
                            @endif
                            @if(isset($publishedHotel->phone_number))
                            <tr>
                                <th class="article-table_th">TEL</th>
                                <td class="article-table_td"><a href="tel:{{$publishedHotel->phone_number}}">{{ $publishedHotel->phone_number }}</a></td>
                            </tr>
                            @endif
                            @if(isset($publishedHotel->url))
                            <tr>
                                <th class="article-table_th">HP</th>
                                <td class="article-table_td"><a href="{{$publishedHotel->url}}">{{ $publishedHotel->url }}</a></td>
                            </tr>
                            @endif
                            <tr>
                                <th class="article-table_th">定休日</th>
                                <td class="article-table_td">
                                    @php
                                        $notEmptyHolidays = $publishedHotel->publishedMonthlyHolidays->filter(function ($holiday) {
                                            return $holiday->week !== null && $holiday->day !== null;
                                        });
                                    @endphp
                                
                                    @if ($notEmptyHolidays->isEmpty())
                                        なし
                                    @else
                                        @foreach($notEmptyHolidays as $publishedMonthlyHoliday)
                                            {{ $publishedMonthlyHoliday->week }}{{ $publishedMonthlyHoliday->day }}曜日<br/>
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                            @if(isset($publishedHotel->publishedTemporaryHolidays))
                            <tr>
                                <th class="article-table_th">臨時定休日</th>
                                <td class="article-table_td">
                                    @php
                                        $notEmptyTmpHolidays = $publishedHotel->publishedTemporaryHolidays->filter(function ($holiday) {
                                            return $holiday->week !== null && $holiday->day !== null;
                                        });
                                    @endphp
                                
                                    @if ($notEmptyTmpHolidays->isEmpty())
                                        なし
                                    @else
                                        @foreach($publishedHotel->publishedTemporaryHolidays as $publishedTemporaryHoliday)
                                            {{ \Carbon\Carbon::parse($publishedTemporaryHoliday->date)->format('Y年n月j日') }}<br/>
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                            @endif
                            @if(isset($publishedHotel->check_in))
                                <tr class="article-table_th">
                                    <th class="article-table_th">チェックイン</th>
                                    <td class="article-table_td">{{ \Carbon\Carbon::createFromFormat('H:i:s', $publishedHotel->check_in)->format('G:i') }}</td>
                                </tr>
                            @endif
                            @if(isset($publishedHotel->check_out))
                                <tr>
                                    <th class="article-table_th">チェックアウト</th>
                                    <td class="article-table_td">{{ \Carbon\Carbon::createFromFormat('H:i:s', $publishedHotel->check_out)->format('G:i') }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </section>

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
            slidesPerView: 2,
            loop:true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    });
</script>
@endsection
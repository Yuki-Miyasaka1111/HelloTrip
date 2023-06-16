@extends('layouts.client')


@section('content')

@include('components.client.popup.success.flash-success')

@include('components.client.popup.errors.flash-error')

<form action="{{ isset($selected_hotel) ? route('project.hotel.updateBasicInformation', $selected_hotel->id) : route('project.hotel.storeBasicInformation') }}" method="POST" enctype="multipart/form-data" class="dev-container">
    @csrf

    @if(isset($selected_hotel))
        @method('PUT')
    @endif
    <x-client.partials.preview-save-button :links="[
        ['title' => 'ホテル情報'],
        ['title' => '基本情報']
    ]" />

    <x-client.partials.project-information-box title="基本情報">
        <div class="form-group d-flex justify-start items-stretch">
            <x-client.labels.label label="画像" class="flex-wrap" alignItems="items-baseline"  />
            <div class="d-flex flex-wrap">
                <x-client.inputs.image name="hotel_images">
                    @if(isset($hotelImages))
                        @foreach ($hotelImages as $i => $hotelImage)
                            <x-client.inputs.image_displayArea :img_path="$hotelImage->path" :index="$i + 1" />
                        @endforeach
                        @for ($i = count($hotelImages); $i < $imageSlots; $i++)
                            <x-client.inputs.image_displayArea :index="$i + 1" />
                        @endfor
                    @endif
                </x-client.inputs.image>
            </div>
            @error('hotel_images')
            <span style="color:red;">ホテル画像をアップロードしてください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start">
            <x-client.labels.label label="宿泊施設名" alignItems="items-center" required />
            <div class="p-1">
                <x-client.inputs.text name="name" width="520px" :value="$selected_hotel->name" placeholder="宿泊施設名を入力(最大40文字)" />
            </div>
            @error('name')
            <span style="color:red;">宿泊施設名を40文字以内で入力してください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start">
            <x-client.labels.label label="施設規模" alignItems="items-center" required />
            <div class="p-1">
                <x-client.inputs.select name="facility_scale" selectedOption="{{ $selected_hotel->facility_scale }}" width="200px" placeholder="施設規模を選択">
                    <option value="1" @if($selected_hotel->facility_scale == 1) selected @endif>1〜30室</option>
                    <option value="2" @if($selected_hotel->facility_scale == 2) selected @endif>30〜50室</option>
                    <option value="3" @if($selected_hotel->facility_scale == 3) selected @endif>50〜100室</option>
                    <option value="4" @if($selected_hotel->facility_scale == 4) selected @endif>101室以上</option>
                </x-client.inputs.select>
            </div>
            @error('facility_scale')
            <span class="ml-1-5 d-flex items-center" style="color:red;">施設規模を選択してください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start">
            <x-client.labels.label label="カテゴリ" alignItems="items-center" required />
            <div class="p-1">
                <x-client.inputs.select name="category_id" selectedOption="{{ $selected_hotel->category_id }}" width="200px" placeholder="カテゴリを選択">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if($category->id == $selected_hotel->category_id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </x-client.inputs.select>
            </div>
            @error('category_id')
            <span class="ml-1-5 d-flex items-center" style="color:red;">カテゴリを選択してください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start">
            <x-client.labels.label label="エリア" alignItems="items-center" required />
            <div class="p-1">
                <x-client.inputs.select name="prefecture_id" selectedOption="{{ $selected_hotel->prefecture_id }}" width="200px" placeholder="都道府県を選択">
                    @foreach ($prefectures as $prefecture)
                        <option value="{{ $prefecture->id }}" @if($prefecture->id == $selected_hotel->prefecture_id) selected @endif>{{ $prefecture->name }}</option>
                    @endforeach
                </x-client.inputs.select>
                <!-- <x-client.inputs.select name="prefecture_id" selectedOption="{{ $selected_hotel->prefecture_id }}" width="200px" placeholder="地域を選択" class="ml-1">
                    @foreach ($prefectures as $prefecture)
                        <option value="{{ $prefecture->prefecture_id }}" @if($prefecture->prefecture_id == $selected_hotel->prefecture_id) selected @endif>{{ $prefecture->name }}</option>
                    @endforeach
                </x-client.inputs.select> -->
            </div>
            @error('prefecture_id')
            <span class="ml-1-5 d-flex items-center" style="color:red;">エリアを選択してください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start">
            <x-client.labels.label label="キャッチコピー" alignItems="items-center" required />
            <div class="p-1">
                <x-client.inputs.text name="catch_copy" width="520px" :value="$selected_hotel->catch_copy" placeholder="例：全客室露天風呂付きの贅沢空間(20文字以内)" />
            </div>
            @error('catch_copy')
            <span class="d-flex items-center" style="color:red;">キャッチコピーを20文字以内で入力してください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start">
            <x-client.labels.label label="最低宿泊単価 / 人" alignItems="items-center" />
            <div class="pl-1 d-flex items-center">
                <x-client.inputs.text name="minimum_price" width="200px" :value="$selected_hotel->minimum_price" placeholder="29,800" /><p class="pl-1">円 / 人(税込)</p>
            </div>
            @error('minimum_price')
            <span class="ml-1-5 d-flex items-center" style="color:red;">最低宿泊単価を数字で入力してください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start">
            <x-client.labels.label label="郵便番号" alignItems="items-center" required />
            <div class="pl-1 d-flex items-center">
                <x-client.inputs.text name="postal_code" width="200px" :value="$selected_hotel->postal_code" placeholder="例：123-4567" />
            </div>
            @error('postal_code')
            <span class="ml-1-5 d-flex items-center" style="color:red;">郵便番号を数字で入力してください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start">
            <x-client.labels.label label="住所1" alignItems="items-center" required />
            <div class="p-1">
                <x-client.inputs.text name="address_1" width="520px" :value="$selected_hotel->address_1" placeholder="市区  例：渋谷区" />
            </div>
            @error('address_1')
            <span class="ml-1-5 d-flex items-center" style="color:red;">住所1を140文字以内で入力してください</span>
            @enderror
        </div>
        
        <div class="form-group d-flex justify-start">
            <x-client.labels.label label="住所2" alignItems="items-center" required />
            <div class="p-1">
                <x-client.inputs.text name="address_2" width="520px" :value="$selected_hotel->address_2" placeholder="町村番地  例：広尾1-2-1" />
            </div>
            @error('address_2')
            <span class="ml-1-5 d-flex items-center" style="color:red;">住所2を140文字以内で入力してください</span>
            @enderror
        </div>
        
        <div class="form-group d-flex justify-start">
            <x-client.labels.label label="住所3" alignItems="items-center" />
            <div class="p-1">
                <x-client.inputs.text name="address_3" width="520px" :value="$selected_hotel->address_3" placeholder="ビル名  例：ヒカリビル4F" />
            </div>
            @error('address_3')
            <span class="ml-1-5 d-flex items-center" style="color:red;">住所3を140文字以内で入力してください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start items-stretch ">
            <x-client.labels.label label="アクセス" alignItems="items-baseline" />
            <div class="p-1">
                <x-client.inputs.textarea name="access" width="520px" height="fit-content" :description="$selected_hotel->access" placeholder="施設までのアクセス方法に関する説明文を入力(最大250文字)" />
            </div>
            @error('access')
            <span class="my-1-2-5 ml-1-5 d-flex items-center" style="color:red;">アクセスを250文字以内で入力してください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start">
            <x-client.labels.label label="TEL" alignItems="items-center" required />
            <div class="p-1">
                <x-client.inputs.text name="phone_number" width="520px" :value="$selected_hotel->phone_number" placeholder="012-3456-7890" />
            </div>
            @error('phone_number')
            <span class="ml-1-5 d-flex items-center" style="color:red;">電話番号を入力してください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start items-strtch ">
            <x-client.labels.label label="HP" alignItems="items-center" required />
            <div class="p-1">
                <x-client.inputs.text name="url" width="520px" :value="$selected_hotel->url" placeholder="https://hellotrip.jp" />
            </div>
            @error('url')
            <span class="ml-1-5 d-flex items-center" style="color:red;">URLを140文字以内で入力してください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start">
            <x-client.labels.label label="チェックイン" alignItems="items-center" required />
            <div class="p-1">
                <x-client.inputs.text type="time" name="check_in" width="160px" :value="$selected_hotel->check_in" placeholder="00:00" />
            </div>
            @error('check_in')
            <span class="ml-1-5 d-flex items-center" style="color:red;">チェックイン時間を入力してください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start">
            <x-client.labels.label label="チェックアウト" alignItems="items-center" required />
            <div class="p-1">
                <x-client.inputs.text type="time" name="check_out" width="160px" :value="$selected_hotel->check_out" placeholder="00:00" />
            </div>
            @error('check_out')
            <span class="ml-1-5 d-flex items-center" style="color:red;">チェックアウト時間を入力してください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start">
            <x-client.labels.label label="駐車場情報" alignItems="items-center" />
            <div class="p-1">
                <x-client.inputs.text name="parking_information" width="520px" :value="$selected_hotel->parking_information" placeholder="例：有 最大収容60台：1泊税込2,000円 / 1台(40文字以内)" />
            </div>
            @error('parking_information')
            <span style="color:red;">駐車場情報を40文字以内で入力してください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start">
            <x-client.labels.label label="月定休日" alignItems="items-baseline" />
            <div class="p-1">
                @if ($selected_hotel->temporaryHolidays->count() > 0)
                    @foreach($selected_hotel->monthlyHolidays as $monthlyHoliday)
                    <div class="form-append monthly-holiday-slot d-flex items-center mb-1" data-id="{{ $monthlyHoliday->id }}">
                        <x-client.inputs.select name="monthly_holiday_week[]" selectedOption="{{ $monthlyHoliday->week }}" width="90px">
                            <option value="1" @if($monthlyHoliday->week == 1) selected @endif>第1</option>
                            <option value="2" @if($monthlyHoliday->week == 2) selected @endif>第2</option>
                            <option value="3" @if($monthlyHoliday->week == 3) selected @endif>第3</option>
                            <option value="4" @if($monthlyHoliday->week == 4) selected @endif>第4</option>
                            <option value="5" @if($monthlyHoliday->week == 5) selected @endif>第5</option>
                        </x-client.inputs.select>

                        <x-client.inputs.select name="monthly_holiday_day[]" selectedOption="{{ $monthlyHoliday->day }}" width="90px" class="ml-1" showDelete="true" outside="曜日">
                            <option value="月" @if($monthlyHoliday->day == "月") selected @endif>月</option>
                            <option value="火" @if($monthlyHoliday->day == "火") selected @endif>火</option>
                            <option value="水" @if($monthlyHoliday->day == "水") selected @endif>水</option>
                            <option value="木" @if($monthlyHoliday->day == "木") selected @endif>木</option>
                            <option value="金" @if($monthlyHoliday->day == "金") selected @endif>金</option>
                        </x-client.inputs.select>
                    </div>
                    @endforeach
                @else
                <div class="form-append monthly-holiday-slot d-flex items-center mb-1">
                    <x-client.inputs.select name="monthly_holiday_week[]" width="90px">
                        <option value="" selected></option>
                        <option value="1">第1</option>
                        <option value="2">第2</option>
                        <option value="3">第3</option>
                        <option value="4">第4</option>
                        <option value="5">第5</option>
                    </x-client.inputs.select>

                    <x-client.inputs.select name="monthly_holiday_day[]" width="90px" class="ml-1" showDelete="true" outside="曜日">
                        <option value="" selected></option>
                        <option value="月">月</option>
                        <option value="火">火</option>
                        <option value="水">水</option>
                        <option value="木">木</option>
                        <option value="金">金</option>
                    </x-client.inputs.select>
                </div>
                @endif
                <div>
                    <div class="text-center mt-1 js-addMonthlyHoliday cursor-pointer">+定休日を追加</div>
                </div>
            </div>
            @error('monthly_holiday')
            <span class="ml-1-5 d-flex items-center" style="color:red;">月定休日を入力してください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start">
            <x-client.labels.label label="臨時定休日" alignItems="items-baseline"/>
            <div class="p-1">
                @if ($selected_hotel->temporaryHolidays->count() > 0)
                    @foreach ($selected_hotel->temporaryHolidays as $temporaryHoliday)
                        <div class="form-append temporary-holiday-slot mb-1">
                            <x-client.inputs.text type="date" name="temporary_holiday[]" width="250px" :value="$temporaryHoliday->date" placeholder="年 / 月 / 日" showDelete="true" />
                        </div>
                    @endforeach
                @else
                    <div class="form-append temporary-holiday-slot mb-1">
                        <x-client.inputs.text type="date" name="temporary_holiday[]" width="250px" placeholder="年 / 月 / 日" showDelete="true" />
                    </div>
                @endif
                <div>
                    <div class="text-center mt-1 js-addTemporaryHoliday cursor-pointer">+臨時定休日を追加</div>
                </div>
            </div>
            @error('temporary_holiday')
            <span class="ml-1-5 d-flex items-center" style="color:red;">臨時定休日を入力してください</span>
            @enderror
        </div>

        <div class="d-flex justify-start items-stretch ">
            <x-client.labels.label label="その他の情報" alignItems="items-baseline" />
            <div class="p-1">
                <x-client.inputs.textarea name="other_information" width="520px" height="220px" :description="$selected_hotel->other_information" placeholder="その他に関する説明文を入力(最大250文字)" />
            </div>
            @error('other_information')
            <span class="my-1-2-5 ml-1-5 d-flex items-center" style="color:red;">その他に関する説明文を250文字以内で入力してください</span>
            @enderror
        </div>
    </x-client.partials.project-information-box>
</form>
@endsection
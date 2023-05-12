@extends('layouts.client')


@section('content')

@include('components.popup.success.flash-success')

@include('components.popup.errors.flash-error')

<x-partials.preview-save-button :links="[
    ['title' => 'ホテル情報'],
    ['title' => '基本情報']
]" />

<form action="{{ isset($selected_hotel) ? route('project.hotel.updateBasicInformation', $selected_hotel->id) : route('project.hotel.storeBasicInformation') }}" method="POST" enctype="multipart/form-data">
    <x-partials.preview-save-button :links="[
        ['title' => 'ホテル情報'],
        ['title' => '基本情報']
    ]" />

    <x-partials.project-information-box title="基本情報">
        @csrf

        @if(isset($selected_hotel))
            @method('PUT')
        @endif
        
        <div class="form-group d-flex justify-start items-stretch">
            <x-labels.label label="画像" class="flex-wrap" />
            <div class="d-flex flex-wrap">
                @for ($i = 0; $i < 8; $i++)
                    <x-inputs.image :image-url="$image_url"/>
                @endfor
            </div>
            @error('images')
            <span style="color:red;">ホテル画像をアップロードしてください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start items-center ">
            <x-labels.label label="宿泊施設名" />
            <div class="pl-1">
                <x-inputs.text name="name" width="520px" :value="$selected_hotel->name" placeholder="宿泊施設名を入力(最大40文字)" />
            </div>
            @error('name')
            <span style="color:red;">宿泊施設名を40文字以内で入力してください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start items-center ">
            <x-labels.label label="施設規模" />
            <div class="pl-1">
                <x-inputs.select name="category_id" selectedOption="{{ $selected_hotel->category_id }}" width="200px" placeholder="施設規模を選択">
                    @foreach ($categories as $category)
                        <option value="{{ $category->category_id }}" @if($category->category_id == $selected_hotel->category_id) selected @endif>{{ $category->category_name }}</option>
                    @endforeach
                </x-inputs.select>
            </div>
            @error('category_id')
            <span class="ml-1-5" style="color:red;">施設規模を選択してください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start items-center ">
            <x-labels.label label="カテゴリ" />
            <div class="pl-1">
                <x-inputs.select name="category_id" selectedOption="{{ $selected_hotel->category_id }}" width="200px" placeholder="カテゴリを選択">
                    @foreach ($categories as $category)
                        <option value="{{ $category->category_id }}" @if($category->category_id == $selected_hotel->category_id) selected @endif>{{ $category->category_name }}</option>
                    @endforeach
                </x-inputs.select>
            </div>
            @error('category_id')
            <span class="ml-1-5" style="color:red;">カテゴリを選択してください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start items-center ">
            <x-labels.label label="エリア" />
            <div class="pl-1">
                <x-inputs.select name="region_id" selectedOption="{{ $selected_hotel->region_id }}" width="200px" placeholder="都道府県を選択">
                    @foreach ($regions as $region)
                        <option value="{{ $region->region_id }}" @if($region->region_id == $selected_hotel->region_id) selected @endif>{{ $region->region_name }}</option>
                    @endforeach
                </x-inputs.select>
                <x-inputs.select name="region_id" selectedOption="{{ $selected_hotel->region_id }}" width="200px" placeholder="地域を選択" class="ml-1">
                    @foreach ($regions as $region)
                        <option value="{{ $region->region_id }}" @if($region->region_id == $selected_hotel->region_id) selected @endif>{{ $region->region_name }}</option>
                    @endforeach
                </x-inputs.select>
            </div>
            @error('region_id')
            <span class="ml-1-5" style="color:red;">エリアを選択してください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start items-center ">
            <x-labels.label label="キャッチコピー" />
            <div class="pl-1">
                <x-inputs.text name="name" width="520px" :value="$selected_hotel->name" placeholder="例：全客室露天風呂付きの贅沢空間(20文字以内)" />
            </div>
            @error('name')
            <span style="color:red;">キャッチコピーを20文字以内で入力してください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start items-center ">
            <x-labels.label label="最低宿泊単価 / 人" />
            <div class="pl-1 d-flex items-center">
                <x-inputs.text name="price" width="200px" :value="$selected_hotel->price" placeholder="29,800" /><p class="pl-1">円 / 人(税込)</p>
            </div>
            @error('price')
            <span class="ml-1-5" style="color:red;">最低宿泊単価を数字で入力してください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start items-center ">
            <x-labels.label label="郵便番号" />
            <div class="pl-1 d-flex items-center">
                <x-inputs.text name="price" width="200px" :value="$selected_hotel->price" placeholder="例：123-4567" />
            </div>
            @error('price')
            <span class="ml-1-5" style="color:red;">郵便番号を数字で入力してください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start items-center ">
            <x-labels.label label="住所" />
            <div class="pl-1">
                <x-inputs.text name="price" width="520px" :value="$selected_hotel->address" placeholder="住所" />
            </div>
            @error('address')
            <span class="ml-1-5" style="color:red;">住所を140文字以内で入力してください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start items-center ">
            <x-labels.label label="URL" />
            <div class="pl-1">
                <x-inputs.text name="url" width="520px" :value="$selected_hotel->url" placeholder="URL" />
            </div>
            @error('url')
            <span class="ml-1-5" style="color:red;">URLを140文字以内で入力してください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start items-center ">
            <x-labels.label label="電話番号" />
            <div class="pl-1">
                <x-inputs.text name="phone_number" width="520px" :value="$selected_hotel->phone_number" placeholder="電話番号" />
            </div>
            @error('phone_number')
            <span class="ml-1-5" style="color:red;">電話番号を入力してください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start items-stretch ">
            <x-labels.label label="詳細" />
            <div class="pl-1">
                <x-inputs.textarea name="phone_number" width="520px" height="fit-content" :description="$selected_hotel->description" placeholder="詳細" />
            </div>
            @error('description')
            <span class="my-1-2-5 ml-1-5 d-flex items-center" style="color:red;">詳細を140文字以内で入力してください</span>
            @enderror
        </div>
    </x-project-information-box>
</form>
@endsection
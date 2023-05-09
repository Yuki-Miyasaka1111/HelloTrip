@extends('layouts.client')


@section('content')

@if (session('success'))
    @include('components.popup.success.flash-success')
@endif

@if ($errors->any())
    @include('components.popup.errors.flash-error')
@endif
<x-partials.preview-save-button :links="[
    ['title' => 'ホテル情報'],
    ['title' => '設備']
]" />

<x-partials.project-information-box title="設備">
    <form action="{{ isset($hotel) ? route('project.hotel.updateFacilities', $hotel->id) : route('project.hotel.storeFacilities') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @if(isset($hotel))
            @method('PUT')
        @endif
        
        <div class="form-group d-flex justify-start items-center ">
            @for ($i = 0; $i < 4; $i++)
                <x-inputs.image :image-url="$image_url"/>
            @endfor
            @error('images')
            <span style="color:red;">ホテル画像をアップロードしてください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start items-center ">
            <x-labels.label label="施設名" />
            <x-inputs.text name="name" width="520px" :value="$hotel->name" placeholder="名前" />
            @error('name')
            <span style="color:red;">ホテル名を20文字以内で入力してください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start items-center ">
            <x-labels.label label="価格" />
            <x-inputs.text name="price" width="520px" :value="$hotel->price" placeholder="価格" />
            @error('price')
            <span class="ml-1-5" style="color:red;">価格を数字で入力してください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start items-center ">
            <x-labels.label label="住所" />
            <x-inputs.text name="price" width="520px" :value="$hotel->address" placeholder="住所" />
            @error('address')
            <span class="ml-1-5" style="color:red;">住所を140文字以内で入力してください</span>
            @enderror
        </div>
        <div class="form-group d-flex justify-start items-center ">
            <x-labels.label label="URL" />
            <x-inputs.text name="url" width="520px" :value="$hotel->url" placeholder="URL" />
            @error('url')
            <span class="ml-1-5" style="color:red;">URLを140文字以内で入力してください</span>
            @enderror
        </div>
        <div class="form-group d-flex justify-start items-center ">
            <x-labels.label label="電話番号" />
            <x-inputs.text name="phone_number" width="520px" :value="$hotel->phone_number" placeholder="電話番号" />
            @error('phone_number')
            <span class="ml-1-5" style="color:red;">電話番号を入力してください</span>
            @enderror
        </div>
        <div class="form-group d-flex justify-start items-stretch ">
            <x-labels.label label="詳細" />
            <x-inputs.textarea name="phone_number" width="520px" height="fit-content" :description="$hotel->description" placeholder="詳細" />
            @error('description')
            <span class="my-1-2-5 ml-1-5 d-flex items-center" style="color:red;">詳細を140文字以内で入力してください</span>
            @enderror
        </div>
        <div class="form-group d-flex justify-start items-center ">
            <x-labels.label label="カテゴリ" />
            <x-inputs.select name="category_id" selectedOption="{{ $hotel->category_id }}" width="fit-content" placeholder="カテゴリを選択してください">
                @foreach ($categories as $category)
                    <option value="{{ $category->category_id }}" @if($category->category_id == $hotel->category_id) selected @endif>{{ $category->category_name }}</option>
                @endforeach
            </x-inputs.select>
            @error('category_id')
            <span class="ml-1-5" style="color:red;">カテゴリを選択してください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start items-center ">
            <x-labels.label label="地域" />
            <x-inputs.select name="region_id" selectedOption="{{ $hotel->region_id }}" width="fit-content" placeholder="地域を選択してください">
                @foreach ($regions as $region)
                    <option value="{{ $region->region_id }}" @if($region->region_id == $hotel->region_id) selected @endif>{{ $region->region_name }}</option>
                @endforeach
            </x-inputs.select>
            @error('region_id')
            <span class="ml-1-5" style="color:red;">地域を選択してください</span>
            @enderror
        </div>
            <button type="submit" class="btn btn-primary w-100">変更</button>
        </div>
    </form>
</x-project-information-box>
@endsection
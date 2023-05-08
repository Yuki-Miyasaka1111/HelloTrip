@extends('layouts.client')


@section('content')

@if (session('success'))
    @include('components.popup.success.flash-success')
@endif

@if ($errors->any())
    @include('components.popup.errors.flash-error')
@endif
<x-partials.project-information-box>
    <form action="{{ isset($hotel) ? route('project.hotel.updateConcept', $hotel->id) : route('project.hotel.storeConcept') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @if(isset($hotel))
            @method('PUT')
        @endif
        
        <div class="row">
            <div class="d-flex">
                @for ($i = 0; $i < 4; $i++)
                    <x-inputs.image :image-url="$image_url"/>
                @endfor
                @error('images')
                <span style="color:red;">ホテル画像をアップロードしてください</span>
                @enderror
            </div>
            <div class="col-12 mb-2 mt-2">
                <div class="form-group">
                    <input type="text" name="name" value="{{ $hotel->name }}" class="form-control" placeholder="名前">
                    @error('name')
                    <span style="color:red;">ホテル名を20文字以内で入力してください</span>
                    @enderror
                </div>
            </div>
            <div class="col-12 mb-2 mt-2">
                <div class="form-group">
                    <input type="text" name="price" value="{{ $hotel->price }}" class="form-control" placeholder="価格">
                    @error('price')
                    <span style="color:red;">価格を数字で入力してください</span>
                    @enderror
                </div>
            </div>
            <div class="col-12 mb-2 mt-2">
                <div class="form-group">
                    <input type="text" name="address" value="{{ $hotel->address }}" class="form-control" placeholder="住所">
                    @error('address')
                    <span style="color:red;">住所を140文字以内で入力してください</span>
                    @enderror
                </div>
            </div>
            <div class="col-12 mb-2 mt-2">
                <div class="form-group">
                    <input type="text" name="url" value="{{ $hotel->url }}" class="form-control" placeholder="URL">
                    @error('url')
                    <span style="color:red;">URLを140文字以内で入力してください</span>
                    @enderror
                </div>
            </div>
            <div class="col-12 mb-2 mt-2">
                <div class="form-group">
                    <input type="text" name="phone_number" value="{{ $hotel->phone_number }}" class="form-control" placeholder="電話番号">
                    @error('phone_number')
                    <span style="color:red;">電話番号を入力してください</span>
                    @enderror
                </div>
            </div>
            <div class="col-12 mb-2 mt-2">
                <div class="form-group">
                    <textarea class="form-control" style="height:100px" name="description" placeholder="詳細">{{ $hotel->description }}</textarea>
                    @error('description')
                    <span style="color:red;">詳細を140文字以内で入力してください</span>
                    @enderror
                </div>
            </div>
            <div class="col-12 mb-2 mt-2">
                <div class="form-group">
                    <select name="category_id" class="form-select">
                        <option>カテゴリを選択してください</otion>
                        @foreach ($categories as $category)
                            <option value="{{ $category->category_id }}"@if($category->category_id==$hotel->category_id) selected @endif>{{ $category->category_name }}</otion>
                        @endforeach
                    </select>
                    @error('category_id')
                    <span style="color:red;">カテゴリを選択してください</span>
                    @enderror
                </div>
            </div>
            <div class="col-12 mb-2 mt-2">
                <div class="form-group">
                    <select name="region_id" class="form-select">
                        <option>地域をを選択してください</otion>
                        @foreach ($regions as $region)
                            <option value="{{ $region->region_id }}"@if($region->region_id==$hotel->region_id) selected @endif>{{ $region->region_name }}</otion>
                        @endforeach
                    </select>
                    @error('region_id')
                    <span style="color:red;">地域を選択してください</span>
                    @enderror
                </div>
            </div>
            <div class="col-12 mb-2 mt-2">
                <button type="submit" class="btn btn-primary w-100">変更</button>
            </div>
        </div>      
    </form>
</x-project-information-box>
@endsection
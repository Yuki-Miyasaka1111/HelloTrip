@extends('layouts.client')
   
@section('content')
<div class="dev-container">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="font-size:1rem;">ホテル登録画面</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ url('/project') }}">戻る</a>
        </div>
    </div>
</div>
 
<div style="text-align:right;">
    <form action="{{ route('project.hotel.store') }}" method="POST">
        @csrf
        
        <div class="row">
            <div class="col-12 mb-2 mt-2">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="名前">
                    @error('name')
                    <span style="color:red;">ホテル名を20文字以内で入力してください</span>
                    @enderror
                </div>
            </div>
            <div class="col-12 mb-2 mt-2">
                <div class="form-group">
                    <input type="text" name="price" class="form-control" placeholder="価格">
                    @error('price')
                    <span style="color:red;">価格を数字で入力してください</span>
                    @enderror
                </div>
            </div>
            <div class="col-12 mb-2 mt-2">
                <div class="form-group">
                    <input type="text" name="address" class="form-control" placeholder="住所">
                    @error('address')
                    <span style="color:red;">住所を140文字以内で入力してください</span>
                    @enderror
                </div>
            </div>
            <div class="col-12 mb-2 mt-2">
                <div class="form-group">
                    <input type="text" name="url" class="form-control" placeholder="URL">
                    @error('url')
                    <span style="color:red;">URLを140文字以内で入力してください</span>
                    @enderror
                </div>
            </div>
            <div class="col-12 mb-2 mt-2">
                <div class="form-group">
                    <input type="text" name="phone_number" class="form-control" placeholder="電話番号">
                    @error('phone_number')
                    <span style="color:red;">電話番号を入力してください</span>
                    @enderror
                </div>
            </div>
            <div class="col-12 mb-2 mt-2">
                <div class="form-group">
                    <textarea class="form-control" style="height:100px" name="description" placeholder="詳細"></textarea>
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
                            <option value="{{ $category->category_id }}">{{ $category->category_name }}</otion>
                        @endforeach
                    </select>
                    @error('category_id')
                    <span style="color:red;">カテゴリを選択してください</span>
                    @enderror
                </div>
            </div>
            <div class="col-12 mb-2 mt-2">
                <div class="form-group">
                    <select name="prefecture_id" class="form-select">
                        <option>地域をを選択してください</otion>
                        @foreach ($prefectures as $prefecture)
                            <option value="{{ $prefecture->prefecture_id }}">{{ $prefecture->prefecture_name }}</otion>
                        @endforeach
                    </select>
                    @error('prefecture_id')
                    <span style="color:red;">地域を選択してください</span>
                    @enderror
                </div>
            </div>
            <div class="col-12 mb-2 mt-2">
                <button type="submit" class="btn btn-primary w-100">登録</button>
            </div>
        </div>      
    </form>
</div>
@endsection
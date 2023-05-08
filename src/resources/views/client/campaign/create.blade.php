@extends('layouts.app')
   
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="font-size:1rem;">キャンペーン登録画面</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ url('/project/campaign') }}">戻る</a>
        </div>
    </div>
</div>
 
<div style="text-align:right;">
    <form action="{{ route('project.campaign.store') }}" method="POST">
        @csrf
        
        <div class="row">
            <div class="col-12 mb-2 mt-2">
                <div class="form-group">
                    <input type="text" name="title" class="form-control" placeholder="タイトル">
                    @error('title')
                    <span style="color:red;">キャンペーン名を20文字以内で入力してください</span>
                    @enderror
                </div>
            </div>
            <div class="col-12 mb-2 mt-2">
                <div class="form-group">
                    <input type="date" name="start_date" class="form-control" min="2022-01-01" max="2030-12-31">
                    @error('start_date')
                    <span style="color:red;">キャンペーン開始日を日にちで入力してください</span>
                    @enderror
                </div>
            </div>
            <div class="col-12 mb-2 mt-2">
                <div class="form-group">
                    <input type="date" name="end_date" class="form-control" min="2022-01-01" max="2030-12-31">
                    @error('end_date')
                    <span style="color:red;">キャンペーン終了日を日にちで入力してください</span>
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
            <div class="col-12 mb-2 mt-2 text-start">
                <div class="form-group">
                    <label for="hotels">対象ホテル:</label>
                    @foreach(Auth::guard('client')->user()->hotels as $hotel)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="hotels[]" value="{{ $hotel->id }}" id="hotel_{{ $hotel->id }}">
                        <label class="form-check-label" for="hotel_{{ $hotel->id }}">
                            {{ $hotel->name }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-12 mb-2 mt-2">
                <button type="submit" class="btn btn-primary w-100">登録</button>
            </div>
        </div>      
    </form>
</div>
@endsection
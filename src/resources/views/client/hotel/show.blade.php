@extends('layouts.app')
   
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="font-size:1rem;">ホテル詳細画面</h2>
        </div>
        <div class="pull-right">
            @auth
            <a class="btn btn-success" href="{{ url('/project/hotel') }}?page={{ $page_id }}">戻る</a>
            @endauth
            @guest
            <a class="btn btn-success" href="{{ url('/') }}?page={{ $page_id }}">戻る</a>
            @endguest
        </div>
    </div>
</div>
 
<div style="text-align:left;">
    <form action="{{ route('project.hotel.update',$hotel->id) }}" method="POST">
        @method('PUT')
        @csrf
        
        <div class="row">
            <div class="col-12 mb-2 mt-2">
                <div class="form-group">
                    {{ $hotel->name }}                
                </div>
            </div>
            <div class="col-12 mb-2 mt-2">
                <div class="form-group">
                    {{ $hotel->price }}                
                </div>
            </div>
            <div class="col-12 mb-2 mt-2">
                <div class="form-group">
                    @foreach ($categories as $category)
                        @if($category->category_id==$hotel->category_id) {{ $category->category_name }} @endif
                    @endforeach         
                </div>
            </div>
            <div class="col-12 mb-2 mt-2">
                <div class="form-group">
                {{ $hotel->description }}                
                </div>
            </div>
        </div>    
    </form>
</div>
@endsection
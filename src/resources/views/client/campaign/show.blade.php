@extends('layouts.app')
   
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="font-size:1rem;">ホテル詳細画面</h2>
        </div>
        <div class="pull-right">
            @auth
            <a class="btn btn-success" href="{{ url('/project/campaign') }}?page={{ $page_id }}">戻る</a>
            @endauth
        </div>
    </div>
</div>
 
<div style="text-align:left;">
    <form action="{{ route('project.campaign.update',$campaign->id) }}" method="POST">
        @method('PUT')
        @csrf
        
        <div class="row">
            <div class="col-12 mb-2 mt-2">
                <div class="form-group">
                    {{ $campaign->title }}                
                </div>
            </div>
            <div class="col-12 mb-2 mt-2">
                <div class="form-group">
                    {{ $campaign->start_date }}                
                </div>
            </div>
            <div class="col-12 mb-2 mt-2">
                <div class="form-group">
                    {{ $campaign->end_date }}                
                </div>
            </div>
            <div class="col-12 mb-2 mt-2">
                <div class="form-group">
                    @foreach ($hotels as $hotel)
                        {{ $hotel->name }}
                    @endforeach         
                </div>
            </div>
            <div class="col-12 mb-2 mt-2">
                <div class="form-group">
                {{ $campaign->description }}                
                </div>
            </div>
        </div>    
    </form>
</div>
@endsection
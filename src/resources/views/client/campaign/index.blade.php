@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="text-left">
                <h2 style="font-size:1rem;">キャンペーン管理画面</h2>
                <h2 style="font-size:1rem;">{{ $client_name }}</h2>
            </div>
            <div class="text-right">
            @if(count(Auth::guard('client')->user()->hotels) > 0)
                <a class="btn btn-success" href="{{ route('project.campaign.create') }}">新規登録</a>
            @else
                <a class="btn btn-success disabled" href="{{ route('project.campaign.create') }}">新規登録</a>
            @endif
            </div>
        </div>
    </div>
 
    <table class="table table-bordered">
        <tr>
            <th style="text-align:right">No</th>
            <th style="text-align:right">キャンペーンタイトル</th>
            <th style="text-align:right">開始日</th>
            <th style="text-align:right">終了日</th>
            <th style="text-align:right">詳細</th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($campaigns as $campaign)
        <tr>
            <td style="text-align:right">{{ $campaign->id }}</td>
            <td style="text-align:right"><a href="{{ route('project.campaign.show',$campaign->id) }}?page_id={{ $page_id }}">{{ $campaign->title }}</a></td>
            <td style="text-align:right">{{ $campaign->start_date }}</td>
            <td style="text-align:right">{{ $campaign->end_date }}</td>
            <td style="text-align:right">{{ $campaign->description }}</td>
            <td style="text-align:center">
                <a class="btn btn-primary" href="{{ route('project.campaign.edit', $campaign->id) }}?page_id={{ $page_id }}">変更</a>
            </td>
            <td style="text-align:center">
                <form action="{{ route('project.campaign.destroy', $campaign->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick='return confirm("削除しますか？");' >削除</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {!! $campaigns->links('pagination::bootstrap-5') !!}

@endsection
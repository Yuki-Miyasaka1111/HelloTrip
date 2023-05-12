@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="text-left">
                <h2 style="font-size:1rem;">管理画面</h2>
                <h2 style="font-size:1rem;">{{ $client_name }}</h2>
            </div>
            <div class="text-right">
            <a class="btn btn-success" href="{{ route('project.hotel.create') }}">新規登録</a>
            </div>
        </div>
    </div>
 
    <table class="table table-bordered">
        <tr>
            <th style="text-align:right">No</th>
            <th style="text-align:right">ホテル名</th>
            <th style="text-align:right">価格</th>
            <th style="text-align:right">カテゴリ</th>
            <th style="text-align:right">地域</th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($hotels as $hotel)
        <tr>
            <td style="text-align:right">{{ $hotel->id }}</td>
            <td style="text-align:right"><a href="{{ route('project.hotel.index',$hotel->id) }}?page_id={{ $page_id }}">{{ $hotel->name }}</a></td>
            <td style="text-align:right">{{ $hotel->price }}円</td>
            <td style="text-align:right">{{ $hotel->category->category_name }}</td>
            <td style="text-align:right">{{ $hotel->prefecture->prefecture_name }}</td>
            <td style="text-align:center">
                <a class="btn btn-primary" href="{{ route('project.hotel.edit', $hotel->id) }}?page_id={{ $page_id }}">変更</a>
            </td>
            <td style="text-align:center">
                <form action="{{ route('project.hotel.destroy', $hotel->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick='return confirm("削除しますか？");' >削除</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {!! $hotels->links('pagination::bootstrap-5') !!}

@endsection
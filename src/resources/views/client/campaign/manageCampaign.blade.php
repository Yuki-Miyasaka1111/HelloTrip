@extends('layouts.client')


@section('content')

@include('components.popup.success.flash-success')

@include('components.popup.errors.flash-error')
<div class="dev-container">
    <x-partials.preview-save-button :links="[
            ['title' => 'キャンペーン情報'],
            ['title' => 'キャンペーン管理']
        ]"
        :btn="false" 
    />

    <x-partials.project-information-table-box title="キャンペーン管理" btnTitle="新規キャンペーン登録" :selected_hotel="$selected_hotel">
        <table class="campaign-table width-full">
            <tbody>
                <tr>
                    <th class="text-left p-1">タイトル</th>
                    <th class="text-left p-1">公開日</th>
                    <th class="text-left p-1">公開終了日</th>
                    <th class="text-left p-1">ステータス</th>
                    <th class="text-left p-1">累計金額</th>
                    <th class="text-left p-1">操作</th>
                </tr>
                @foreach($campaigns as $campaign)
                <tr>
                    <td>{{ $campaign->title }}</td>
                    <td>{{ $campaign->start_date }}</td>
                    <td>{{ $campaign->end_date }}</td>
                    <td>{{ $campaign->status }}</td>
                    <td>{{ $campaign->total_amount }}</td>
                    <td><!-- 操作ボタン等 --></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </x-project-information-table-box>
</div>
@endsection
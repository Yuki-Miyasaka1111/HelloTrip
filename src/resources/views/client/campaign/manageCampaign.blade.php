@extends('layouts.client')


@section('content')

@include('components.client.popup.success.flash-success')

@include('components.client.popup.errors.flash-error')
<div class="dev-container">
    <x-client.partials.preview-save-button :links="[
            ['title' => 'キャンペーン情報'],
            ['title' => 'キャンペーン管理']
        ]"
        :btn="false" 
    />

    <x-client.partials.project-information-table-box title="キャンペーン管理" btnTitle="新規キャンペーン登録" :selected_hotel="$selected_hotel">
        <table class="campaign-table width-full">
            <tbody>
                <tr>
                    <th class="text-left p-1">タイトル</th>
                    <th class="text-center p-1">公開日</th>
                    <th class="text-center p-1">公開終了日</th>
                    <th class="text-center p-1">ステータス</th>
                    <th class="text-center p-1">累計金額</th>
                    <th class="text-center p-1">操作</th>
                </tr>
                @foreach($selected_campaigns as $selected_campaign)
                <tr>
                    <td class="text-left p-1">
                        <div><a href="">{{ $selected_campaign->title }}</a></div>
                    </td>
                    <td class="text-center p-1">{{ \Carbon\Carbon::parse($selected_campaign->publication_date)->format('Y-m-d') }}</td>
                    <td class="text-center p-1">
                        @if($selected_campaign->end_publication_date)
                            {{ \Carbon\Carbon::parse($selected_campaign->end_publication_date)->format('Y-m-d') }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-center p-1 {{ $selected_campaign->publish_status == 2 ? 'private_status' : '' }}">
                        {{ $selected_campaign->publish_status == 1 ? '公開中' : '非公開' }}
                    </td>
                    <td class="text-center p-1">{{ $selected_campaign->total_amount }}</td>
                    <td class="text-center p-1">
                        <div class="d-flex justify-center items-baseline">
                            <a href="{{ route('project.campaign.editCampaign', ['hotel_id' => $selected_hotel->id, 'campaign_id' => $selected_campaign->id]) }}">編集</a>
                            <p class="mx-1">|</p>
                            <a href="">プレビュー</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </x-project-information-table-box>
</div>
@endsection
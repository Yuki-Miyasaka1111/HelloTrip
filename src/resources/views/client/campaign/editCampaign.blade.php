@extends('layouts.client')


@section('content')

@include('components.client.popup.success.flash-success')

@include('components.client.popup.errors.flash-error')

<form action="{{ isset($selected_hotel) ? route('project.campaign.updateCampaign', ['hotel_id' => $selected_hotel->id, 'campaign_id' => $selected_campaign->id]) : route('project.campaign.storeCampaign') }}" method="PUT" enctype="multipart/form-data" class="dev-container">
    @csrf
    
    <x-client.partials.preview-save-button :links="[
        ['title' => 'キャンペーン情報'],
        ['title' => 'キャンペーン編集']
    ]" />

    <x-client.partials.project-information-box title="投稿設定">
        <div class="form-group d-flex justify-start ">
            <x-client.labels.label label="公開日" alignItems="items-baseline"/>
            <div class="py-1-2-5 px-1">
                <x-client.inputs.checkbox_type2 label="予約せずにすぐに公開する" id="immediate_publication_set" name="immediate_publication_set" :value="$selected_campaign->immediate_publication_set" :checked="$selected_campaign->immediate_publication_set" />
                <div class="d-flex justify-between mt-1">
                    <x-client.inputs.text type="date" width="250px" name="publication_date" value="{{ \Carbon\Carbon::parse($selected_campaign->publication_date)->format('Y-m-d') }}" placeholder="年 / 月 / 日" />
                    <div class="ml-1">
                        <x-client.inputs.text type="time" name="publication_time" width="160px" value="{{ \Carbon\Carbon::parse($selected_campaign->publication_date)->format('H:i') }}" placeholder="00:00" />
                    </div>
                </div>
            </div>
            @error('publication_date')
            <span class="my-1-2-5 ml-1-5 d-flex items-center" style="color:red;">公開日を入力してください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start ">
            <x-client.labels.label label="公開終了日" alignItems="items-baseline"/>
            <div class="py-1-2-5 px-1">
                <x-client.inputs.checkbox_type2 label="公開終了日を設定する" id="end_publication_set" name="end_publication_set" :value="$selected_campaign->end_publication_set" :checked="$selected_campaign->end_publication_set" />
                <div class="d-flex justify-between mt-1">
                    @if($selected_campaign->end_publication_date)
                        <x-client.inputs.text type="date" name="end_publication_date" value="{{ \Carbon\Carbon::parse($selected_campaign->end_publication_date)->format('Y-m-d') }}" width="250px" placeholder="年 / 月 / 日" />
                        <div class="ml-1">
                            <x-client.inputs.text type="time" name="end_publication_time" width="160px" value="{{ \Carbon\Carbon::parse($selected_campaign->end_publication_date)->format('H:i') }}" placeholder="00:00" />
                        </div>
                    @else
                        <x-client.inputs.text type="date" name="end_publication_date" value="" width="250px" placeholder="年 / 月 / 日" />
                        <div class="ml-1">
                            <x-client.inputs.text type="time" name="end_publication_time" width="160px" value="" placeholder="00:00" />
                        </div>
                    @endif
                </div>
            </div>
            @error('end_publication_date')
            <span class="my-1-2-5 ml-1-5 d-flex items-center" style="color:red;">公開を終了する日にちを入力してください</span>
            @enderror
            @error('end_publication_time')
            <span class="my-1-2-5 ml-1-5 d-flex items-center" style="color:red;">公開を終了する時間を入力してください</span>
            @enderror
        </div>

        <div class="d-flex justify-start">
            <x-client.labels.label label="ステータス" alignItems="items-center"/>
            <div class="p-1">
                <x-client.inputs.select name="publish_status" selectedOption="{{ $selected_campaign->publish_status ?? '' }}" width="200px" >
                    <option value="1" @if(old('publish_status', $selected_campaign->publish_status ?? '') == 1) selected @endif>公開</option>
                    <option value="2" @if(old('publish_status', $selected_campaign->publish_status ?? '') == 2) selected @endif>非公開</option>
                </x-client.inputs.select>
            </div>
        </div>
    </x-client.partials.project-information-box>

    <x-client.partials.project-information-box title="キャンペーン設定">
        <div class="form-group d-flex justify-start items-stretch">
            <x-client.labels.label label="アイキャッチ画像" class="flex-wrap" alignItems="items-baseline"  />
            <div class="d-flex flex-wrap">
            @if(isset($campaignImage))
                <x-client.inputs.image name="campaign_image" multiple="False" :img_path="$campaignImage" />
            @else
                <x-client.inputs.image name="campaign_image" multiple="False" />
            @endif
            </div>
            @error('images')
            <span style="color:red;">ホテル画像をアップロードしてください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start">
            <x-client.labels.label label="キャンペーン期間" alignItems="items-center" required/>
            <div class="p-1 d-flex items-center">
                <x-client.inputs.text type="date" name="campaign_start_date" :value="isset($selected_campaign->campaign_start_date) ? \Carbon\Carbon::parse($selected_campaign->campaign_start_date)->format('Y-m-d') : ''" width="250px" />
                <p class="px-1">～</p>
                <x-client.inputs.text type="date" name="campaign_end_date" :value="isset($selected_campaign->campaign_end_date) ? \Carbon\Carbon::parse($selected_campaign->campaign_end_date)->format('Y-m-d') : ''" width="250px" placeholder="年 / 月 / 日"  />
            </div>
        </div>

        <div class="d-flex justify-start">
            <x-client.labels.label label="タイトル" alignItems="items-center" required />
            <div class="p-1">
                <x-client.inputs.text name="title" width="520px" :value="$selected_campaign->title" placeholder="タイトルを入力(最大40文字)" />
            </div>
            @error('title')
            <span class="d-flex items-center" style="color:red;">タイトルを40文字以内で入力してください</span>
            @enderror
        </div>
    </x-client.partials.project-information-box>

    <x-client.partials.project-information-box title="本文">
        <div class="p-1-2-5">
            <input id="campaign-article" value="{{ old('content', optional($selected_campaign)->content) }}" type="hidden" name="content">
            <trix-editor input="campaign-article" style="height:256px;"></trix-editor>
            <div id="preview-area"></div>
        </div>
    </x-client.partials.project-information-box>
</form>
@endsection
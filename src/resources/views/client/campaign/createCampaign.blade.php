@extends('layouts.client')


@section('content')

@include('components.client.popup.success.flash-success')

@include('components.client.popup.errors.flash-error')

<form action="{{ route('project.campaign.storeCampaign', ['hotel_id' => $selected_hotel->id]) }}" method="POST" enctype="multipart/form-data" class="dev-container">
    @csrf
    
    <x-client.partials.preview-save-button :links="[
        ['title' => 'キャンペーン情報'],
        ['title' => 'キャンペーン新規登録']
    ]" />

    <x-client.partials.project-information-box title="投稿設定">
        <div class="form-group d-flex justify-start ">
            <x-client.labels.label label="公開日" alignItems="items-baseline"/>
            <div class="py-1-2-5 px-1">
                <x-client.inputs.checkbox_type2 label="予約せずにすぐに公開する" id="immediate_publication_set" name="immediate_publication_set" :value="$campaign->immediate_publication_set" :checked="$campaign->immediate_publication_set" />
                <div class="d-flex justify-between mt-1">
                    <x-client.inputs.text type="date" width="250px" name="publication_date" value="" placeholder="年 / 月 / 日" />
                    <div class="ml-1">
                        <x-client.inputs.text type="time" name="publication_time" width="160px" value="" placeholder="00:00" />
                    </div>
                </div>
            </div>
            @error('publication_date')
            <span class="my-1-2-5 ml-1-5 d-flex items-center" style="color:red;">コンセプトを250文字以内で入力してください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start ">
            <x-client.labels.label label="公開終了日" alignItems="items-baseline"/>
            <div class="py-1-2-5 px-1">
                <x-client.inputs.checkbox_type2 label="公開終了日を設定する" id="end_publication_set" name="end_publication_set" :value="$campaign->end_publication_set" :checked="$campaign->end_publication_set" />
                <div class="d-flex justify-between mt-1">
                    @if($campaign->end_publication_date)
                        <x-client.inputs.text type="date" name="end_publication_date" value="{{ \Carbon\Carbon::parse($campaign->end_publication_date)->format('Y-m-d') }}" width="250px" placeholder="年 / 月 / 日" />
                        <div class="ml-1">
                            <x-client.inputs.text type="time" name="end_publication_time" width="160px" value="{{ \Carbon\Carbon::parse($campaign->end_publication_date)->format('H:i') }}" placeholder="00:00" />
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
                <x-client.inputs.select name="publish_status" selectedOption="{{ $campaign->publish_status ?? '' }}" width="200px" >
                    <option value="1" @if(old('publish_status', $campaign->publish_status ?? '') == 1) selected @endif>公開</option>
                    <option value="0" @if(old('publish_status', $campaign->publish_status ?? '') == 0) selected @endif selected>非公開</option>
                </x-client.inputs.select>
            </div>
        </div>
    </x-project-information-box>

    <x-client.partials.project-information-box title="キャンペーン設定">
        <div class="form-group d-flex justify-start items-stretch">
            <x-client.labels.label label="アイキャッチ画像" class="flex-wrap" alignItems="items-baseline"  />
            <div class="d-flex flex-wrap">
                <x-client.inputs.image name="campaign_images">
                    @for ($i = 0; $i < $imageSlots; $i++)
                        <x-client.inputs.image_displayArea :index="$i + 1" />
                    @endfor
                </x-client.inputs.image>
            </div>
            @error('images')
            <span style="color:red;">キャンペーン画像をアップロードしてください</span>
            @enderror
        </div>

        <div class="form-group d-flex justify-start">
            <x-client.labels.label label="キャンペーン期間" alignItems="items-center" required/>
            <div class="p-1 d-flex items-center">
                <x-client.inputs.text type="date" name="campaign_start_date" :value="isset($campaign->campaign_start_date) ? \Carbon\Carbon::parse($campaign->campaign_start_date)->format('Y-m-d') : ''" width="250px" />
                <p class="px-1">～</p>
                <x-client.inputs.text type="date" name="campaign_end_date" :value="isset($campaign->campaign_end_date) ? \Carbon\Carbon::parse($campaign->campaign_end_date)->format('Y-m-d') : ''" width="250px" placeholder="年 / 月 / 日"  />
            </div>
            @error('campaign_end_date')
            <span style="color:red;">キャンペーン期間を正しく設定してください</span>
            @enderror
        </div>

        <div class="d-flex justify-start">
            <x-client.labels.label label="タイトル" alignItems="items-center" required />
            <div class="p-1">
                <x-client.inputs.text name="title" width="520px" :value="$campaign->title" placeholder="タイトルを入力(最大40文字)" />
            </div>
            @error('title')
            <span class="d-flex items-center" style="color:red;">タイトルを40文字以内で入力してください</span>
            @enderror
        </div>
    </x-project-information-box>

    <x-client.partials.project-information-box title="本文">
        <div class="p-1-2-5">
            <input id="campaign-article" value="{{ old('content', optional($campaign)->content) }}" type="hidden" name="content">
            <trix-editor input="campaign-article" style="height:256px;"></trix-editor>
            <div id="preview-area"></div>
        </div>
    </x-project-information-box>
</form>
@endsection
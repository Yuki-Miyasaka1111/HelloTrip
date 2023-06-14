@props(['class' => '', 'hotel'])

<div class="{{ $class }}">
    <div class="bg-primary d-flex flex-col justify-center height-full p-1">
        <div class="dashboard_publication_heading d-flex justify-between items-center">
            <p>本番環境</p>
            <span> @if($hotel->last_updated)最終更新日:{{ \Carbon\Carbon::parse($hotel->last_updated)->format('Y.m.d') }}@endif</span>
        </div>
        <x-client.buttons.primary class="py-0-5 mt-1" style="font-size:0.875rem;">
            データを更新する
        </x-client.buttons.primary>

        <x-client.buttons.primary class="py-0-5 mt-1" bgColor="#a5a5a5" style="font-size:0.875rem;">
            データを非公開にする
        </x-client.buttons.primary>
    </div>
</div>
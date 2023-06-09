@props(['links', 'btn' => true])

<div class="preview-save-button-wrap p-2 d-flex items-center justify-between bg-primary">
    <div class="preview-save-button-breadcrumb d-flex items-center justify-between">
        @foreach ($links as $link)
            @if ($loop->last)
                <h3 class="preview-save-button-breadcrumb-item py-1-1-2-5">{{ $link['title'] }}</h3>
            @else
                <h3 class="preview-save-button-breadcrumb-item py-1-1-2-5 mr-2-5">{{ $link['title'] }}</h3>
            @endif
        @endforeach
    </div>
    @if ($btn)
    <div>
        <x-client.buttons.primary class="px-4 py-1-1-2-5 font-weight-bold" bg-color="#AABAC6">プレビュー</x-client.buttons.primary>
        <x-client.buttons.primary class="px-4 py-1-1-2-5 ml-1 font-weight-bold">保存する</x-client.buttons.primary>
    </div>
    @endif
</div>
@props(['links'])

<div class="preview-save-button-wrap p-2 d-flex items-center justify-between bg-primary">
    <div class="preview-save-button-breadcrumb d-flex items-center justify-between">
        @foreach ($links as $link)
            @if ($loop->last)
                <h3 class="preview-save-button-breadcrumb-item">{{ $link['title'] }}</h3>
            @else
                <h3 class="preview-save-button-breadcrumb-item mr-2-5">{{ $link['title'] }}</h3>
            @endif
        @endforeach
    </div>
    <div>
        <x-buttons.primary class="px-4 py-1-1-2-5 font-weight-bold" bg-color="#AABAC6">プレビュー</x-buttons.primary>
        <x-buttons.primary class="px-4 py-1-1-2-5 ml-1 font-weight-bold" bg-color="linear-gradient(to right, #CE858F, #506584)">保存する</x-buttons.primary>
    </div>
</div>
@props(['img_path' => '', 'index'])

<div class="upload-image-wrap m-1-5" id="upload-image-wrap-{{ $index }}" data-index="{{ $index }}">
    <div id="dragDropArea" class="upload-image-zone width-full height-full d-flex justify-center items-center flex-wrap text-center">
        <div id="previewArea"></div>
        
        @if(empty($img_path))
            <img src="{{ asset('assets/img/icons/c-image_icon.svg') }}" class="default-image">
        @else
            <img src="{{ asset('storage/' . $img_path) }}" class="show-db-image">
        @endif
    </div>
</div>
@props(['name', 'img_path' => '', 'multiple' => 'True'])

<label class="upload-image-wrap m-1-5">
    <input id="fileInput" type="file" accept="image/*" {!! $multiple == 'True' ? 'multiple' : '' !!} name="{{ $name }}{{ $multiple == 'True' ? '[]' : '' }}" multiple class="d-none input-image" hidden>
    <div id="dragDropArea" class="upload-image-zone width-full height-full d-flex justify-center items-center flex-wrap text-center">
        <div id="previewArea"></div>
        
        @if(empty($img_path))
            <img src="{{ asset('assets/img/icons/c-image_icon.svg') }}" id="default-image">
        @else
            <img src="{{ asset('storage/' . $img_path) }}" id="show-db-image">
        @endif
    </div>
</label>
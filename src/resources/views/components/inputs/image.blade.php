@props(['name', 'img_path' => '', 'multiple' => 'True'])

<label class="upload-image-wrap m-1-5">
    <input type="file" name="{{ $name }}{{ $multiple == 'True' ? '[]' : '' }}" multiple class="d-none input-image">
    <div class="upload-image-zone width-full height-full d-flex justify-center items-center flex-wrap text-center">
        <img src="" class="drop-image show-drop-image">
        
        @if(empty($img_path))
            <img src="{{ asset('assets/img/icons/c-image_icon.svg') }}" class="default-image">
        @else
            <img src="{{ asset('storage/' . $img_path) }}" class="show-db-image">
        @endif
    </div>
</label>
@props(['name', 'img_path' => ''])

<label class="d-flex flex-wrap">
    <input id="fileInput" type="file" accept="image/*" multiple name="{{ $name }}[]" class="d-none input-image" hidden>
    {{ $slot }}
</label>
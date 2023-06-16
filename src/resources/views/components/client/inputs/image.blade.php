@props(['name', 'img_path' => '', 'multiple' => 'True'])

<label class="d-flex flex-wrap">
    <input id="fileInput" type="file" accept="image/*" {!! $multiple == 'True' ? 'multiple' : '' !!} name="{{ $name }}{{ $multiple == 'True' ? '[]' : '' }}" class="d-none input-image" hidden>
    {{ $slot }}
</label>
@props(['name', 'value', 'label', 'checked' => false, 'class' => 'form-checkbox', 'width' => '100%'])

<div class="p-1 d-flex justify-between" style="width: {{ $width }};" >
    <span class="">{{ $label }}</span>
    <label class="inline-flex items-center">
        <input type="checkbox" name="{{ $name }}" value="{{ $value }}" class="{{ $class }}" {{ $checked ? 'checked' : '' }} {!! $attributes !!}>
    </label>
</div>
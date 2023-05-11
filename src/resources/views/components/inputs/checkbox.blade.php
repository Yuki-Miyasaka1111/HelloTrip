@props(['name', 'value', 'label', 'checked' => false, 'class' => 'form-checkbox', 'width' => '100%'])

<div class="{{ $class }}-wrap py-1 pl-1 pr-3 d-flex justify-between" style="width: {{ $width }};" >
    <span class="">{{ $label }}</span>
    <input id="{{ $value }}" type="checkbox" name="{{ $name }}" value="{{ $value }}" class="d-none {{ $class }}" {{ $checked ? 'checked' : '' }} {!! $attributes !!}>
    <label for="{{ $value }}" class="{{ $class }}-label"></label>
</div>
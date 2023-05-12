@props(['name', 'value', 'label', 'id', 'checked' => false, 'class' => 'form-checkbox', 'width' => '100%'])

<div class="{{ $class }}-wrap py-1 pl-1 pr-3 d-flex justify-between" style="width: {{ $width }};" >
    <span class="">{{ $label }}</span>
    <input id="{{ $id }}" type="checkbox" name="{{ $name }}" value="{{ $value }}" class="d-none form-checkbox {{ $class }}" {{ $checked ? 'checked' : '' }} {!! $attributes !!}>
    <label for="{{ $id }}" class="{{ $class }}-label"></label>
</div>

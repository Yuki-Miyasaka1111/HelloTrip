@props(['name', 'value', 'label', 'id', 'checked' => false, 'class' => 'form-checkbox_type2', 'width' => '100%'])

<div class="{{ $class }}-wrap d-flex justify-between" style="width: {{ $width }};" >
    <input type="hidden" name="{{ $name }}" value="0">
    <input id="{{ $id }}" type="checkbox" name="{{ $name }}" value="1" class="d-none {{ $class }}" {{ $checked ? 'checked' : '' }} {!! $attributes !!}>
    <label for="{{ $id }}" class="{{ $class }}-label">{{ $label }}</label>
</div>
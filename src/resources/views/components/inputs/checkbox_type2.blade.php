@props(['name', 'value', 'label', 'id', 'checked' => false, 'class' => 'form-checkbox_type2', 'width' => '100%'])

<div class="{{ $class }}-wrap d-flex justify-between" style="width: {{ $width }};" >
    <input id="{{ $id }}" type="checkbox" name="{{ $name }}" value="{{ $value }}" class="d-none form-checkbox_type2 {{ $class }}" {{ $checked ? 'checked' : '' }} {!! $attributes !!}>
    <label for="{{ $id }}" class="{{ $class }}-label">{{ $label }}</label>
</div>

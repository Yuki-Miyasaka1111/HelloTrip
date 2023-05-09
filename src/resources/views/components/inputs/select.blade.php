@props(['name', 'selectedOption' => null, 'placeholder' => '', 'class' => 'form-input form-select', 'width' => '100%'])

<select name="{{ $name }}" class="{{ $class }}" style="width: {{ $width }};" {!! $attributes !!}>
    <option value="">{{ $placeholder }}</option>
    {{ $slot }}
</select>
@props(['name', 'selectedOption' => null, 'placeholder' => '', 'class' => 'form-input form-select', 'width' => '100%'])

<select name="{{ $name }}" class="form-input form-select {{ $class }}" style="width: {{ $width }};" {!! $attributes !!}>
    <option value="">{{ $placeholder }}</option>
    {{ $slot }}
</select>
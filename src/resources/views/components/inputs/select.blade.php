@props(['name', 'selectedOption' => null, 'placeholder' => '', 'value'=> '', 'class' => 'form-input form-select', 'width' => '100%'])

<select name="{{ $name }}" class="form-input form-select {{ $class }}" style="width: {{ $width }};" {!! $attributes !!}>
    <option value="{{ $value }}">{{ $placeholder }}</option>
    {{ $slot }}
</select>
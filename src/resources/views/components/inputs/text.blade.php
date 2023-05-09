@props(['name', 'value' => '', 'placeholder' => '', 'class' => 'form-input form-text', 'width' => '100%'])

<input type="text" name="{{ $name }}" value="{{ $value }}" class="{{ $class }}" placeholder="{{ $placeholder }}" style="width: {{ $width }};" {!! $attributes !!}>
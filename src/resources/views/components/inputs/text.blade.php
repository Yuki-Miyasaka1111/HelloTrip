@props(['name', 'type' => 'text', 'value' => '', 'placeholder' => '', 'class' => 'form-input form-text', 'width' => '100%'])

<input type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" class="form-input form-text {{ $class }}" placeholder="{{ $placeholder }}" style="width: {{ $width }};" {!! $attributes !!}>
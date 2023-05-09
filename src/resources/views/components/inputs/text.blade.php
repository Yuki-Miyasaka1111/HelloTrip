@props(['name', 'value' => '', 'placeholder' => '', 'class' => 'form-input form-text', 'width' => '100%'])

<div class="pl-1">
    <input type="text" name="{{ $name }}" value="{{ $value }}" class="{{ $class }}" placeholder="{{ $placeholder }}" style="width: {{ $width }};" {!! $attributes !!}>
</div>
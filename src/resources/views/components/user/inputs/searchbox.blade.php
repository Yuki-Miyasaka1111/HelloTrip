@props(['name', 'type' => 'text', 'value' => '', 'placeholder' => '', 'class' => 'form-searchbox form-text', 'width' => '100%'])

<div class="d-flex form-{{ $name }}-wrap">
    <input id="{{ $name }}" type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" class="{{ $class }}" placeholder="{{ $placeholder }}" style="width: {{ $width }};" {!! $attributes !!}>
</div>
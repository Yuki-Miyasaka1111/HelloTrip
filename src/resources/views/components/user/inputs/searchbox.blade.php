@props(['name', 'type' => 'text', 'value' => '', 'placeholder' => '', 'class' => 'form-searchbox form-text', 'width' => '100%', 'position'=>'absolute'])

<div class="d-flex form-{{ $name }}-wrap" style="position: {{ $position }};">
    <input id="{{ $name }}" type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" class="{{ $class }}" placeholder="{{ $placeholder }}" style="width: {{ $width }};" {!! $attributes !!}>
</div>
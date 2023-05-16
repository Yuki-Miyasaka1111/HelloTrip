@props(['name', 'type' => 'text', 'value' => '', 'placeholder' => '', 'class' => 'form-input form-text', 'width' => '100%', 'showDelete' => false])

<div class="d-flex items-center form-{{ $name }}">
    <input type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" class="form-input form-text {{ $class }}" placeholder="{{ $placeholder }}" style="width: {{ $width }};" {!! $attributes !!}>
    @if($showDelete)
        <div class="js-delete-clone js-delete-{{ $name }} ml-1 cursor-pointer">×</div>
    @endif
</div>
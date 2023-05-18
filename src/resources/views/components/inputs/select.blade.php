@props(['name', 'selectedOption' => null, 'placeholder' => null, 'value'=> '', 'class' => 'form-input form-select', 'width' => '100%', 'showDelete' => false, 'outside'=>''])

<div class="d-flex items-center">
    <select name="{{ $name }}" class="form-input form-select {{ $class }}" style="width: {{ $width }};" {!! $attributes !!}>
        @if(!is_null($placeholder))
            <option value="{{ $value }}">{{ $placeholder }}</option>
        @endif
        {{ $slot }}
    </select>
    @if($showDelete)
        <p class="ml-1">{{ $outside }}</p>
        <div class="js-delete-clone ml-1 cursor-pointer">×</div>
    @endif
</div>
@props(['name', 'placeholder' => '', 'description' => '', 'class' => 'form-input form-textarea', 'width' => '100%', 'height' => ''])

<textarea name="{{ $name }}" class="form-input form-textarea {{ $class }} " placeholder="{{ $placeholder }}" style="width: {{ $width }}; height: {{ $height }};" {!! $attributes !!}>{{ $description }}</textarea>
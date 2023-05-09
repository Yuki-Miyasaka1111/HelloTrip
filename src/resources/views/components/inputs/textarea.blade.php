@props(['name', 'placeholder' => '', 'description' => '', 'class' => 'form-input form-textarea', 'width' => '100%', 'height' => ''])

<textarea name="{{ $name }}" class="{{ $class }} my-1-2-5" placeholder="{{ $placeholder }}" style="width: {{ $width }}; height: {{ $height }};" {!! $attributes !!}>{{ $description }}</textarea>
@props(['class' => '', 'bgColor' => '', 'style' => ""])

<button class="c-primary__button {{ $class }}" style="background: {{ $bgColor }}; {{ $style }}">
    {{ $slot }}
</button>
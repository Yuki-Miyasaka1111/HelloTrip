<button {{ $attributes->merge(['type' => 'submit', 'class' => 'c-primary__button', 'style' => 'background: ' . $attributes->get('bgColor')]) }}>
    {{ $slot }}
</button>
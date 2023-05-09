<button {{ $attributes->merge(['type' => 'submit', 'class' => 'c-primary__button', 'style' => 'background: ' . $attributes->get('bg-color', 'linear-gradient(to right, #30cfd0, #330867)')]) }}>
    {{ $slot }}
</button>
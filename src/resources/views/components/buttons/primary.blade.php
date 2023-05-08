<button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-5 py-1 c-primary__button']) }}>
    {{ $slot }}
</button>

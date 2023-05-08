<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn bg-gradient-primary']) }}>
    {{ $slot }}
</button>
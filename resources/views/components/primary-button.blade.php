<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary btn-md mt-3']) }}>
    {{ $slot }}
</button>

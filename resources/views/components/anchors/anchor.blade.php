@props(['value'])

<a {{ $attributes->merge(['class' => 'btn-link']) }}>{{ $value ?? $slot }}</a>
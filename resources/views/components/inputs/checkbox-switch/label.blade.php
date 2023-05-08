@props(['value'])

<label {{ $attributes->merge(['class' => 'form-check-label mb-0 ms-3']) }}>{{ $value ?? $slot }}</label>
@props(['checked' => false])

<input {{ $checked ? 'checked' : '' }} type="radio" {{ $attributes->merge(['class' => 'form-check-input']) }}>
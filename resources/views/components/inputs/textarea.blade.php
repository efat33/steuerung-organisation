@props(['disabled' => false, 'value'])

<textarea {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => 'form-control border border-2 p-2']) }}>{{ $value }}</textarea>
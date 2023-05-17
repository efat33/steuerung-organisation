@props(['disabled' => false])

<select {{ $attributes->merge(['class' => 'form-select ps-2']) }}>
    {{$slot}}
</select>
@props(['messages'])

@if ($messages)
@foreach ((array) $messages as $message)
<p class='text-danger inputerror'>{{ $message }} </p>
@endforeach
@endif
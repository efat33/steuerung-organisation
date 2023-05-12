<form {{ $attributes->merge(['class' => 'd-inline-block']) }} method='POST'>
    @csrf
    @method('delete')

    {{ $slot }}
</form>
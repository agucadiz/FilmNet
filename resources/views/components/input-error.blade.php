@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-lg text-red-500 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif

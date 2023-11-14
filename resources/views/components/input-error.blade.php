@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-lg text-red-600 space-y-1 font-semibold']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif

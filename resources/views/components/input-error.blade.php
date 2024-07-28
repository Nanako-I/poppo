@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-red-400 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li class="text-red-500  text-lg">{{ $message }}</li>
        @endforeach
    </ul>
@endif

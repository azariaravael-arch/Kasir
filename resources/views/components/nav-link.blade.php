@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'inline-flex items-center px-4 py-2 text-sm font-bold leading-5 text-white bg-white/20 rounded-lg focus:outline-none transition duration-150 ease-in-out'
        : 'inline-flex items-center px-4 py-2 text-sm font-bold leading-5 text-white/80 hover:text-white hover:bg-white/10 rounded-lg focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
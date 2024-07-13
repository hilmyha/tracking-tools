@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block py-1 text-gray-700 border-b border-primary text-center lg:text-start border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent'
            
            : 'block py-1 text-gray-700 border-b text-center lg:text-start border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary';
@endphp



<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

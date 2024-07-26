@props(['value'])

<label {{ $attributes->merge(['class' => 'block mb-1 font-semibold text-sm text-gray-700 dark:text-gray-300']) }}>
    {{ $value ?? $slot }}
</label>

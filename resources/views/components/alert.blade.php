@props(['type' => 'success'])

@php
    $classes = $type === 'success'
        ? 'bg-green-100 text-green-700'
        : 'bg-red-100 text-red-700';
@endphp

<div {{ $attributes->merge(['class' => "p-3 rounded mb-4 $classes"]) }}>
    {{ $slot }}
</div>
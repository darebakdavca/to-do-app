@props([
    'name',
    'size' => 'size-6 text-[10px]',
])

@php
    $parts = preg_split('/\s+/', trim($name)) ?: [];
    $initials = collect($parts)
        ->filter()
        ->take(2)
        ->map(fn($part) => mb_strtoupper(mb_substr($part, 0, 1)))
        ->implode('');
@endphp

<span
    class="{{ $size }} inline-flex shrink-0 items-center justify-center rounded-full bg-blue-600 font-semibold text-white">
    {{ $initials }}
</span>

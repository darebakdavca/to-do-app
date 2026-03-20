@props(['dueDate', 'format' => 'D. MMMM YYYY', 'showIcon' => true])

@php
    $dueDateValue = \Carbon\Carbon::parse($dueDate)->startOfDay();
    $today = now()->startOfDay();
    $textColor = match (true) {
        $dueDateValue->lt($today) => 'text-red-400',
        $dueDateValue->isSameDay($today) => 'text-sky-400',
        default => 'text-slate-300',
    };
@endphp

<div {{ $attributes->class(['flex items-center gap-1.5 text-sm', $textColor]) }}>
    @if ($showIcon)
        <svg class="size-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
        </svg>
    @endif

    <span class="text-xs">
        {{ $dueDateValue->locale(app()->getLocale())->isoFormat($format) }}
    </span>
</div>

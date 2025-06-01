<div class="mt-4 w-full max-w-[600px] rounded-lg bg-slate-700 p-5 sm:mx-auto">
    <h2 class="mb-2 text-2xl font-semibold">{{ $title ?? '' }}</h2>
    @if (!empty($description ?? null))
        <p>{{ $description }}</p>
    @endif
    <div class="mt-5">
        {{ $slot }}
    </div>
</div>

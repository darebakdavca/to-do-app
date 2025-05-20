<div class="bg-slate-700 p-5 rounded-lg mx-5 sm:mx-auto max-w-[600px] w-full">
    <h2 class="text-2xl font-semibold mb-2">{{ $title ?? ''}}</h2>
    @if (!empty($description ?? null))
        <p>{{ $description }}</p>
    @endif
    <div class="mt-5">
        {{ $slot }}
    </div>
</div>

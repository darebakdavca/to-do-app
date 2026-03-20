<x-layout>
    <x-slot:title>
        Join {{ $taskList->name }}
    </x-slot:title>
    <x-slot:metaTitle>
        {{ $metaTitle }}
    </x-slot:metaTitle>
    <x-slot:metaDescription>
        {{ $metaDescription }}
    </x-slot:metaDescription>
    <x-slot:metaImage>
        {{ $metaImage }}
    </x-slot:metaImage>
    <x-slot:metaUrl>
        {{ $metaUrl }}
    </x-slot:metaUrl>

    <div class="mx-auto flex min-h-[60vh] max-w-3xl items-center">
        <div
            class="grid w-full gap-8 overflow-hidden rounded-3xl border border-slate-700 bg-slate-800 shadow-2xl md:grid-cols-[1.2fr_0.8fr]">
            <div class="flex flex-col justify-between gap-6 bg-gradient-to-br from-slate-800 via-slate-800 to-blue-900/60 p-8">
                <div class="space-y-4">
                    <div
                        class="inline-flex w-fit items-center rounded-full border border-blue-400/40 bg-blue-500/10 px-3 py-1 text-sm font-semibold text-blue-200">
                        Shared task list invite
                    </div>
                    <div class="space-y-3">
                        <h1 class="text-4xl font-bold tracking-tight text-white">
                            {{ $taskList->name }}
                        </h1>
                        <p class="max-w-xl text-lg text-slate-200">
                            {{ $taskList->description ?: 'You were invited to collaborate on a shared task list in To Do App.' }}
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-3 text-sm text-slate-300">
                    <img alt="To Do App" class="size-10 rounded-xl"
                        src="{{ asset('icons/icon-192.png') }}">
                    <div>
                        Join this list to view tasks, due dates, and shared progress.
                    </div>
                </div>
            </div>

            <div class="flex flex-col justify-center gap-5 p-8">
                @if ($invitation->accepted_at)
                    <div class="rounded-2xl bg-slate-900 p-6">
                        <h2 class="text-2xl font-semibold text-white">Invite already used</h2>
                        <p class="mt-3 text-slate-300">
                            This invitation has already been accepted. Ask the owner to generate a new link if
                            you still need access.
                        </p>
                    </div>
                @else
                    <div class="rounded-2xl bg-slate-900 p-6">
                        <h2 class="text-2xl font-semibold text-white">Open invite</h2>
                        <p class="mt-3 text-slate-300">
                            Continue to accept this invitation and join the shared task list.
                        </p>
                        <a class="button mt-5 flex w-full items-center justify-center py-3 text-lg"
                            href="{{ $acceptLink }}">
                            Join task list
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>

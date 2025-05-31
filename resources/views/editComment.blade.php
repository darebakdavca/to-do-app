<x-layout>
    <x-slot:title>Edit comment</x-slot:title>
    <x-container>
        <x-slot:title>Edit comment</x-slot:title>
        <div class="flex flex-col gap-2">
            <form class="form" action="{{ route('comments.update', ['comment' => $comment]) }}"
                method="post">
                @csrf
                @method('PUT')
                <div>
                    <label class="label" for="content">
                        Content
                    </label>
                    <input
                        class="input @error('content') border-red-500 @else border-slate-600 @enderror"
                        id="content" name="content" type="text"
                        value="{{ old('content', $comment->content) }}" aria-required="true">
                    @error('content')
                        <div class="error-msg">{{ $message }}</div>
                    @enderror
                </div>
                <input name="updated_at" type="hidden" value="{{ $comment->updated_at }}">
                <div class="flex gap-2 text-white">
                    <button class="button" type="submit">Save</button>
                    <a class="cancel-button" id="close-btn" type="button"
                        href="{{ url(session('previous_url')) }}">Cancel</a>
                </div>
            </form>
        </div>
    </x-container>
</x-layout>

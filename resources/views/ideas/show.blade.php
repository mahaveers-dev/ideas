<x-layout>
    <div class="">
        <header class="py-8 md:py-12">
            <h1 class="text-3xl font-bold">Ideas</h1>
            <p class="text-muted-foreground text-sm mt-2"> Capture yor thoughts. Make a plan.</p>
        </header>
        <div class="mt-10 text-muted-foreground">
            <div class="grid md:grid-cols-2 gap-6">
                <x-card  href="{{ route('ideas.show', $idea) }}">
                    <h3 class="text-foreground text-lg">{{ $idea->title }}</h3>
                    <span class="inline-block rounded-full border px-2 py-1 text-xs font-medium bg-primary">
                        {{  $idea->status->label() }}
                    </span>
                    <div class="mt-5 line-clamp-3">{{ $idea->description }}</div>
                    <div class="mt-4">{{ $idea->created_at->diffForHumans() }}</div>
                </x-card>
            </div>
        </div>
    </div>
</x-layout>

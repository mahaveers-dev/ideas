<x-layout>
    <div>
        <header class="py-8 md:py-12">
            <h1 class="text-3xl font-bold">Ideas</h1>
            <p class="text-muted-foreground text-sm mt-2"> Capture yor thoughts. Make a plan.</p>
            <x-card 
                x-data
                @click="$dispatch('open-modal', 'create-idea')"
                is="button"
                type="button"
                class="mt-10 cursor-pointer h-32 w-full text-left"
                >
                <p>What's the idea?</p>
            </x-card>
        </header>

        <div>
            <a href="/ideas" class="btn {{ request()->has('status') ? 'btn-outlined' : '' }}">All</a>
            @foreach (App\IdeaStatus::cases() as $status)
                <a 
                    href="/ideas?status={{ $status->value }}" 
                    class="btn {{ request('status') === $status->value ? '' : 'btn-outlined' }}"
                >
                    {{ $status->label() }} <span class="text-xs pl-3">{{ $statusCounts->get($status->value) }}</span>
                </a>
            @endforeach
        </div>

        <div class="mt-10 text-muted-foreground">
            <div class="grid md:grid-cols-2 gap-6">
                @forelse ($ideas as $idea)
                    <x-card  href="{{ route('ideas.show', $idea) }}">
                        <h3 class="text-foreground text-lg">{{ $idea->title }}</h3>
                        <div class="mt-1">
                            <x-idea.status-label status="{{ $idea->status }}">
                                {{  $idea->status->label() }}
                            </x-idea.status-label>
                        </div>

                        <div class="mt-5 line-clamp-3">{{ $idea->description }}</div>
                        <div class="mt-4">{{ $idea->created_at->diffForHumans() }}</div>
                    </x-card>                    
                @empty
                    <x-card>
                        <p>No ideas at this time</p>
                    </x-card>
                @endforelse                
            </div>
        </div>
        <!-- add new idea modal -->
        <x-modal name="create-idea" title="New Idea">
            <form 
                x-data="{
                    status: 'pending',
                    newLink: '',
                    links: []
                }" 
                method="POST" 
                action="{{ route('ideas.store') }}">
                @csrf

                <div class="space-y-6">
                    <x-form.field 
                        label="Title" 
                        name="title" 
                        placeholder="Enter an idea for your title"
                        required
                        autofocus
                    />
                    <div class="space-y-2">
                        <label for="status" class="label">Status</label>
                        <div class="flex gap-x-3">
                            @foreach(App\IdeaStatus::cases() as $status)
                                <button
                                    type="button"
                                    @click="status = @js($status->value)"
                                    class="btn flex-1 h-10"
                                    :class="{'btn-outlined': status !== @js($status->value)}"
                                >                                    
                                {{ $status->label() }}
                                </button>
                            @endforeach
                            <input type="hidden" name="status" id="status" :value="status"/>
                        </div>
                        <x-form.error name="status"/>
                    </div>
                    <x-form.field 
                        label="Description" 
                        name="description" 
                        type="textarea"
                        placeholder="Describe your idea..."
                    />
                    <div>
                        <fieldset class="space-y-3">
                            <legend class="label">Links</legend>
                            <template x-for="(link, index) in links" :key="link">
                                <div class="flex gap-x-2 items-center">
                                    <input type="text" class="input" name="links[]" x-model="link" >
                                    <button 
                                        type="button" 
                                        aria-label="Remove link"
                                        @click="links.splice(index, 1)"
                                        class="form-muted-icon"
                                    >
                                        <x-icons.close />
                                    </button>
                                </div>
                            </template>

                            <div class="flex gap-x-2 items-center">
                                <input
                                    x-model="newLink"
                                    type="url"
                                    id="new-link"
                                    placeholder="https://example.com"
                                    autocomplete="url"
                                    class="input flex-1"
                                    spellcheck="false"
                                >
                                <button 
                                    type="button" 
                                    @click="links.push(newLink.trim()); newLink = '';"
                                    :disabled="newLink.trim().length === 0"
                                    aria-label="Add a new link"
                                    class="form-muted-icon"
                                >
                                    <x-icons.add/>
                                </button>
                            </div>                            
                        </fieldset>
                    </div>
                    <div class="flex justify-end gap-x-5">
                        <button
                            type="button"
                            @click="$dispatch('close-modal')"
                        >
                            Cancel
                        </button>
                        <button
                                type="submit"
                                class="btn"                                
                        >
                            Create Idea
                        </button>
                    </div>
                </div>                
            </form>
        </x-modal>
    </div>
</x-layout>

<x-app-layout>
    <div class="py-4">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">

                <h1 class="text-2xl mb-4">{{ $post->title }}</h1>

                <!-- User Avatar and Info -->
                <div class="flex items-center gap-2 mb-6">
                    <x-user-avatar :user="$post->user" />

                    <div>
                        <div class="flex gap-2">
                            <a class="hover:underline"
                                href="{{ route('public.profile.show', $post->user) }}">{{ $post->user->name }}</a>
                            @if (auth()->user() && auth()->user()->id !== $post->user->id)
                                &middot;

                                <div x-data="{
                                    following: {{ $post->user->isFollowedBy(auth()->user()) ? 'true' : 'false' }},
                                    follow() {
                                        this.following = !this.following;
                                        axios.post('/follow/{{ $post->user->id }}');
                                    }
                                }">
                                    <a href="#" class="hover:underline" x-text="following ? 'Unfollow' : 'Follow'"
                                        :class="following ? 'text-red-500' : 'text-emerald-500'" @click="follow()">

                                    </a>
                                </div>
                            @endif
                        </div>

                        <div class="flex gap-2 text-gray-500 text-sm">
                            {{ $post->readTime() }} min read
                            &middot;
                            {{ $post->formattedCreatedAt() }}
                        </div>
                    </div>
                </div>

                @if ($post->user_id === auth()->id())
                    <div class="pt-8 mt-4 border-t border-gray-200">
                        <x-primary-button :href="route('post.edit', $post->slug)">
                            Edit Post
                        </x-primary-button>
                        <form action="{{ route('post.destroy', $post) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <x-danger-button>
                                Delete Post
                            </x-danger-button>
                        </form>
                    </div>
                @endif

                @auth
                    <x-clap-button :post="$post" />
                @endauth

                <!-- Content Section -->
                <div class="mt-8">

                    <div>
                        {{ $post->content }}
                    </div>
                    <img src="{{ $post->imageUrl() ?? 'https://picsum.photos/800' }}" alt="{{ $post->title }}"
                        class="max-h-80 object-cover mt-4 mx-auto rounded-md">
                </div>

                <!-- Category Section -->
                <div class="mt-8">
                    <span class="px-4 py-2 bg-gray-100 rounded-xl">{{ $post->category->name }}</span>
                </div>

                @auth
                    <x-clap-button :post="$post" />
                @endauth
            </div>
        </div>
    </div>
</x-app-layout>

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
                            &middot;
                            <a href="#" class="text-emerald-500 hover:underline">
                                Follow
                            </a>
                        </div>

                        <div class="flex gap-2 text-gray-500 text-sm">
                            {{ $post->readTime() }} min read
                            &middot;
                            {{ $post->created_at->format('M d, Y') }}
                        </div>
                    </div>
                </div>

                <x-clap-button />

                <!-- Content Section -->
                <div class="mt-8">
                    <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" class="w-full">
                    <div>
                        {{ $post->content }}
                    </div>
                </div>

                <!-- Category Section -->
                <div class="mt-8">
                    <span class="px-4 py-2 bg-gray-100 rounded-xl">{{ $post->category->name }}</span>
                </div>

                <x-clap-button />
            </div>
        </div>
    </div>
</x-app-layout>
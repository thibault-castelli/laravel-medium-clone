<x-app-layout>
    <div class="py-4">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">

                <h1 class="text-2xl mb-4">{{ $post->title }}</h1>

                <!-- User Avatar and Info -->
                <div class="flex items-center gap-2 mb-6">
                    @if ($post->user->image)
                        <img src="{{ $post->user->imageUrl() }}" alt="{{ $post->user->name }}"
                            class="rounded-full w-12 h-12 object-cover">
                    @else
                        <img src="https://www.startpage.com/av/proxy-image?piurl=https%3A%2F%2Fcdn.pixabay.com%2Fphoto%2F2015%2F03%2F04%2F22%2F35%2Fhead-659652_1280.png&sp=1751979290Tf7832da4b6316b52cb0d30dd93bf6a2f5f968e6d951df23f9ca9a643fae4c10e"
                            alt="{{ $post->user->name }}" class="rounded-full w-12 h-12 object-cover">
                    @endif
                    <div>
                        <div class="flex gap-2">
                            <h3>{{ $post->user->name }}</h3>
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
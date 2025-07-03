<x-app-layout>
    <div class="py-4">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-4 text-gray-900">
                    <x-category-tabs>
                        No categories found
                    </x-category-tabs>
                </div>
            </div>

            @forelse($posts as $post)
                <x-post-item :post="$post" />
            @empty
                <div>
                    <p class="text-gray-900 text-center py-16">No posts found.</p>
                </div>
            @endforelse

            {{$posts->links()}}
        </div>
    </div>
</x-app-layout>

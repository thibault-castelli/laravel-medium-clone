<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
      <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="flex">

          <div class="flex-1 pr-8">
            <h1 class="text-5xl">{{ $user->name }}</h1>

            <div class="mt-8">
              @forelse($posts as $post)
          <x-post-item :post="$post" />
        @empty
          <div>
          <p class="text-gray-900 text-center py-16">No posts found.</p>
          </div>
        @endforelse
            </div>
            {{ $posts->links() }}
          </div>

          <div class="w-[320px] border-l px-8">
            <x-user-avatar :user="$user" size="w-24 h-24" />
            <h3>{{ $user->name }}</h3>
            <p class="text-gray-500">26k followers</p>
            <p>
              {{  $user->bio ?? 'This user has not set a bio yet.' }}
            </p>
            <div>
              <button
                class="bg-emerald-500 rounded-full px-4 py-2 mt-4 text-white hover:bg-emerald-600 transition-colors">
                Follow
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
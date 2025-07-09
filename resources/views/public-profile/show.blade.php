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

                    @auth
                        <div x-data="{
                            following: {{ $user->isFollowedBy(auth()->user()) ? 'true' : 'false' }},
                            followersCount: {{ $user->followers()->count() }},
                            follow() {
                                axios.post('/follow/{{ $user->id }}')
                                    .then(response => {
                                        this.followersCount = response.data.followersCount;
                                        this.following = !this.following;
                                    }).catch(error => {
                                        console.error('Error following/unfollowing:', error);
                                    });
                            }
                        }" class="w-[320px] border-l px-8">

                            <x-user-avatar :user="$user" size="w-24 h-24" />

                            <h3>{{ $user->name }}</h3>

                            <p class="text-gray-500"><span x-text="followersCount"></span>
                                <span x-text="followersCount <= 1 ? 'follower' : 'followers'"></span>
                            </p>

                            <p>
                                {{ $user->bio ?? 'This user has not set a bio yet.' }}
                            </p>

                            @if (auth()->user() && auth()->user()->id !== $user->id)
                                <div>
                                    <button @click="follow()"
                                        class="rounded-full px-4 py-2 mt-4 text-white transition-colors"
                                        x-text="following ? 'Unfollow' : 'Follow'"
                                        :class="following ? 'bg-red-500 hover:bg-red-600' :
                                            'bg-emerald-500 hover:bg-emerald-600'">
                                    </button>
                                </div>
                            @endif

                        </div>
                    @endauth

                    @guest
                        <div class="w-[320px] border-l px-8">
                            <x-user-avatar :user="$user" size="w-24 h-24" />

                            <h3>{{ $user->name }}</h3>

                            <p class="text-gray-500"><span x-text="followersCount"></span>
                                <span x-text="followersCount <= 1 ? 'follower' : 'followers'"></span>
                            </p>

                            <p>
                                {{ $user->bio ?? 'This user has not set a bio yet.' }}
                            </p>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

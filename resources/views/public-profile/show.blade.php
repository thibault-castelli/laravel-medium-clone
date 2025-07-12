<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex flex-col-reverse sm:flex-row">

                    <div class="flex-1 pr-8 sm:border-r">
                        <h1 class="hidden text-5xl sm:block">{{ $user->name }}</h1>

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

                    <div class="flex flex-col items-center sm:w-[320px]">
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
                            }" class="w-[320px] px-8">

                                <x-user-avatar :user="$user" size="w-24 h-24" />

                                <h3 class="text-xl mb-3">{{ $user->name }}</h3>

                                @if (auth()->user()->id === $user->id)
                                    <x-primary-button :href="route('profile.edit')" class="mb-4">
                                        Edit Profile
                                    </x-primary-button>
                                @endif

                                <p>
                                    <strong>Bio: </strong>{{ $user->bio ?? 'This user has not set a bio yet.' }}
                                </p>

                                @if (auth()->user() && auth()->user()->id !== $user->id)
                                    <div>
                                        <button @click="follow()"
                                            class="rounded-md px-4 py-1 mt-4 w-full text-white transition-colors"
                                            x-text="following ? 'Unfollow' : 'Follow'"
                                            :class="following ? 'bg-red-500 hover:bg-red-600' :
                                                'bg-emerald-500 hover:bg-emerald-600'">
                                        </button>
                                    </div>
                                @endif

                            </div>
                        @endauth

                        @guest
                            <div class="w-[320px] px-8">
                                <x-user-avatar :user="$user" size="w-24 h-24" />

                                <h3 class="text-xl mb-3">{{ $user->name }}</h3>

                                <p>
                                    <strong>Bio: </strong>{{ $user->bio ?? 'This user has not set a bio yet.' }}
                                </p>
                            </div>
                        @endguest

                        <div class="w-[320px] px-8 mt-6">
                            <strong>Followers:</strong>
                            <ul class="list-disc pl-5">
                                @forelse ($user->followers as $follower)
                                    <li>
                                        <a class="hover:underline"
                                            href="{{ route('public.profile.show', $follower->username) }}">{{ $follower->name }}</a>
                                    </li>
                                @empty
                                    <li class="text-gray-500 list-none">No followers yet.</li>
                                @endforelse
                            </ul>
                        </div>

                        <div class="w-[320px] px-8 mt-6">
                            <strong>Following:</strong>
                            <ul class="list-disc pl-5">
                                @forelse ($user->following as $following)
                                    <li>
                                        <a class="hover:underline"
                                            href="{{ route('public.profile.show', $following->username) }}">{{ $following->name }}</a>
                                    </li>
                                @empty
                                    <li class="text-gray-500 list-none">No following yet.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@props(['user', 'size' => 'w-12 h-12'])

@if ($user->getFirstMedia())
    <a href="{{ route('public.profile.show', $user) }}"><img src="{{ $user->imageUrl() }}" alt="{{ $user->name }}"
            class="rounded-full object-cover {{ $size }}"></a>
@else
    <a href="{{ route('public.profile.show', $user) }}"><img src="{{ Storage::url('avatars/default-avatar.png') }}"
            alt="{{ $user->name }}" class="rounded-full object-cover {{ $size }}"></a>
@endif

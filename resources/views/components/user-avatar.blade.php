@props(['user', 'size' => 'w-12 h-12'])

@if ($user->image)
    <a href="{{ route('public.profile.show', $user) }}"><img src="{{ $user->imageUrl() }}" alt="{{ $user->name }}"
            class="rounded-full object-cover {{ $size }}"></a>
@else
    <a href="{{ route('public.profile.show', $user) }}"><img
            src="https://www.startpage.com/av/proxy-image?piurl=https%3A%2F%2Fcdn.pixabay.com%2Fphoto%2F2015%2F03%2F04%2F22%2F35%2Fhead-659652_1280.png&sp=1751979290Tf7832da4b6316b52cb0d30dd93bf6a2f5f968e6d951df23f9ca9a643fae4c10e"
            alt="{{ $user->name }}" class="rounded-full object-cover {{ $size }}"></a>
@endif
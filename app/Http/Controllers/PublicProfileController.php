<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PublicProfileController extends Controller
{
    const POSTS_PER_PAGE = 5;

    public function show(User $user)
    {
        $posts = $user->posts()
            ->with(['user', 'media'])
            ->withCount('claps')
            ->latest()
            ->simplePaginate(self::POSTS_PER_PAGE);

        return view('public-profile.show', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }
}

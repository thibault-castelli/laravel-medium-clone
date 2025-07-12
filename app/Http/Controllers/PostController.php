<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    const POSTS_PER_PAGE = 5;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = $this->getPostsQuery(Post::query())
            ->simplePaginate(self::POSTS_PER_PAGE);

        return view('post.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();

        return view('post.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($data['title']);

        $post = Post::create($data);

        $post->addMediaFromRequest('image')
            ->toMediaCollection();

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $username, Post $post)
    {
        return view('post.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->validatePostOwnership($post);

        $categories = Category::get();

        return view('post.edit', [
            'post' => $post,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        $this->validatePostOwnership($post);

        $data = $request->validated();
        $post->update($data);

        if ($request->hasFile('image')) {
            $post->media()->each(function ($media) {
                $media->delete();
            });
            $post->addMediaFromRequest('image')
                ->toMediaCollection();
        }

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->validatePostOwnership($post);

        $post->media()->each(function ($media) {
            $media->delete();
        });
        $post->delete();

        return redirect()->route('dashboard');
    }

    /**
     * Display posts by category.
     */
    public function category(Category $category)
    {
        $posts = $this
            ->getPostsQuery($category->posts())
            ->simplePaginate(self::POSTS_PER_PAGE);

        return view('post.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Display the user's posts.
     */
    public function myPosts()
    {
        $user = auth()->user();
        $posts = $this
            ->getPostsQuery($user->posts())
            ->simplePaginate(self::POSTS_PER_PAGE);

        return view('post.index', [
            'posts' => $posts
        ]);
    }

    private function validatePostOwnership(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
    }

    private function getPostsQuery($postsRelation)
    {
        return $postsRelation
            ->with(['user', 'media'])
            ->withCount('claps')
            ->latest();
    }
}

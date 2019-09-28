<?php

namespace App\Http\Controllers;

use App\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = $this->postRepository->getAll();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required',
            'is_published' => 'required',
        ]);
        $this->postRepository->create([
            'user_id' => auth()->id(),
            'title' => $data['title'],
            'content' => $data['content'],
            'is_published' => $data['is_published'] ?? 0,
        ]);

        return redirect()->route('posts');
    }

    public function update(Request $request, Post $post)
    {
        dd($request->all());
        $this->authorize('update', $post);
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required',
            'is_published' => 'required',
        ]);
        $this->postRepository->update($request->all(), $post->id);
        return redirect()->route('posts');
    }

    public function destroy(Post $post)
    {
        $this->authorize('update', $post);
        $this->postRepository->delete($post->id);
        return redirect()->route('posts');
    }
}

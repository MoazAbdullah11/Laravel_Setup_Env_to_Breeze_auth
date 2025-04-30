<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    // This is the correct index method to show posts on the homepage
    public function index()
    {
        $posts = Post::latest()->get();
        return view('home', compact('posts'));
    }

    // Store a new post
    public function store(Request $request)
    {
        $post = Post::create($request->only(['title', 'body']));
        return response()->json($post);
    }

    // Show a specific post
    public function show($id)
    {
        return response()->json(Post::findOrFail($id));
    }

    // Update an existing post
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->only(['title', 'body']));
        return response()->json($post);
    }

    // Delete a post
    public function destroy($id)
    {
        Post::destroy($id);
        return response()->json(['success' => true]);
    }

    // AJAX search for posts
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $posts = Post::where('title', 'like', "%{$query}%")
                         ->orWhere('body', 'like', "%{$query}%")
                         ->get();

            return view('ajax-posts', compact('posts'))->render();
        }

        return response()->json(['message' => 'Bad request'], 400);
    }
}

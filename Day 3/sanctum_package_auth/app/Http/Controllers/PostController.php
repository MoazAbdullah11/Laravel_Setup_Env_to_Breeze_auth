<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('ajax-posts', compact('posts'));
    }

    public function store(Request $request)
    {
        $post = Post::create($request->only(['title', 'body']));
        return response()->json($post);
    }

    public function show($id)
    {
        return response()->json(Post::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->only(['title', 'body']));
        return response()->json($post);
    }

    public function destroy($id)
    {
        Post::destroy($id);
        return response()->json(['success' => true]);
    }


    public function search(Request $request)
{
    $query = $request->get('query');

    $posts = \App\Models\Post::where('title', 'like', "%{$query}%")
        ->orWhere('body', 'like', "%{$query}%")
        ->orderBy('id', 'desc')
        ->get();

    return view('ajax-posts.table', compact('posts'))->render(); // render() for AJAX
}

}

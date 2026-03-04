<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:20480',
        ]);

        // Upload file ke public/images
        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $imageName);

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
            'tags' => $request->tags,
            'category' => $request->category,
            'is_private' => $request->has('is_private'),
            'allow_download' => $request->has('allow_download'),
            'allow_comment' => $request->has('allow_comment'),
        ]);

        return redirect()->route('post.create')->with('success', 'Post berhasil diupload!');
    }
    public function buat(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:20480',
    ]);

    // Buat folder posts kalau belum ada
    if (!file_exists(public_path('posts'))) {
        mkdir(public_path('posts'), 0755, true);
    }

    // Generate nama file unik
    $imageName = time() . '.' . $request->image->extension();

    // Upload ke public/posts
    $request->image->move(public_path('posts'), $imageName);

    Post::create([
        'title' => $request->title,
        'description' => $request->description,
        'image' => $imageName,
        'tags' => $request->tags,
        'category' => $request->category,
        'is_private' => $request->has('is_private'),
        'allow_download' => $request->has('allow_download'),
        'allow_comment' => $request->has('allow_comment'),
    ]);

    return redirect()->route('post.create')
        ->with('success', 'Post berhasil diupload!');
}
}

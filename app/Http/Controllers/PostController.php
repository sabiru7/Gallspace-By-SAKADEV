<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;

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

        // bikin nama file dari title
        $cleanTitle = preg_replace('/[^A-Za-z0-9\-]/', '-', strtolower($request->title));
        $extension = $request->image->extension();
        $imageName = $cleanTitle . '.' . $extension;

        // simpan file manual tanpa angka acak
        $request->image->move(public_path('post'), $imageName);
        // Cek apakah file sudah ada, kalau iya tambahkan angka
        $counter = 1;
        $imagePath = public_path('images/' . $imageName);
        while (file_exists($imagePath)) {
            $imageName = $cleanTitle . '-' . $counter . '.' . $extension;
            $imagePath = public_path('images/' . $imageName);
            $counter++;
        }
        // simpan ke database
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
}
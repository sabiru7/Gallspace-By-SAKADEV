<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    // 🔹 Folder tempat gambar
    protected $imagePath = 'images';

    // 🔹 DASHBOARD / GALERI PUBLIK: tampilkan semua gambar
    public function index()
    {
        // Ambil semua post terbaru
        $images = Post::latest()->get();

        return view('dashboard', compact('images'));
    }

    // 🔹 HALAMAN UPLOAD FORM
    public function create()
    {
        return view('upload');
    }

    // 🔹 PROSES UPLOAD
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:20480', // max 20MB
        ]);

        // Pastikan folder ada
        $path = public_path($this->imagePath);
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $file = $request->file('image');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // simpan ke folder public/images
        $file->move($path, $filename);

        // simpan ke database
        Post::create([
            'user_id' => Auth::id(),
            'image'   => $filename,
        ]);

        return redirect()->route('akun')
                         ->with('success', 'Image uploaded successfully!');
    }

    // 🔹 DELETE IMAGE
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        
        // Hanya bisa dihapus oleh pemilik
        if ($post->user_id !== Auth::id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        // Hapus file fisik
        $filePath = public_path($this->imagePath . '/' . $post->image);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        // Hapus record di DB
        $post->delete();

        return back()->with('success', 'Image deleted successfully.');
    }

    // 🔹 DETAIL IMAGE
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('gallery.show', compact('post'));
    }
    // 🔹 HALAMAN USER AKUN: tampilkan gambar milik user yang login
public function akun()
{
    // Ambil semua post milik user saat ini
    $images = Post::where('user_id', Auth::id())
                  ->latest()
                  ->get();

    // Kirim ke view akun.blade.php
    return view('akun.akun', compact('images'));
}

}

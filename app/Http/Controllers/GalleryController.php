<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    protected $imagePath = 'images';

    // DASHBOARD / GALERI PUBLIK
    public function index()
    {
        $images = Post::latest()->get();
        return view('dashboard', compact('images'));
    }

    // FORM UPLOAD
    public function create()
    {
        return view('upload');
    }

    // PROSES UPLOAD
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:20480', // max 20MB
            'title' => 'required|string|max:255',
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
            'title'   => $request->input('title'), // ❌ sebelumnya typo 'tittle'
        ]);

        return redirect()->route('akun')
                         ->with('success', 'Image uploaded successfully!');
    }

    // DELETE IMAGE
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id !== Auth::id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        $filePath = public_path($this->imagePath . '/' . $post->image);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        $post->delete();

        return back()->with('success', 'Image deleted successfully.');
    }

    // DETAIL IMAGE
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('gallery.show', compact('post'));
    }

    // HALAMAN USER AKUN
    public function akun()
    {
        $images = Post::where('user_id', Auth::id())->latest()->get();
        return view('akun.akun', compact('images'));
    }

    // TRENDING
    public function trending()
    {
        $images = Post::latest()->get();

        $trendingPath = public_path('trending');
        $trendingImages = [];

        if (File::exists($trendingPath)) {
            $files = File::files($trendingPath);
            foreach ($files as $file) {
                $trendingImages[] = asset('trending/' . $file->getFilename());
            }
        }

        return view('jelajah', compact('images', 'trendingImages'));
    }

    // HALAMAN JELAJAH: anime
    public function anime()
    {
        return $this->loadImages('anime', 'anime');
    }

    // HALAMAN JELAJAH: photography
    public function photography()
    {
        return $this->loadImages('photography', 'photography');
    }

    // HALAMAN JELAJAH: art
    public function art()
    {
        return $this->loadImages('art', 'art');
    }

    // HALAMAN JELAJAH: memes
    public function memes()
    {
        return $this->loadImages('meme', 'meme');
    }

    // PRIVATE HELPER FUNCTION UNTUK LOAD IMAGE DARI FOLDER
    private function loadImages($folder, $viewName)
    {
        $path = public_path($folder);
        $images = [];

        if (File::exists($path)) {
            $files = File::files($path);
            foreach ($files as $file) {
                $images[] = asset($folder . '/' . $file->getFilename());
            }
        }

        return view($viewName, ['images' => $images]);
    }
    public function deleteFolderImage(Request $request)
{
    $request->validate([
        'folder' => 'required|string',
        'filename' => 'required|string',
    ]);

    $allowedFolders = ['anime', 'photography', 'art', 'meme', 'trending', 'images', 'post'];

    // Cegah akses folder lain
    if (!in_array($request->folder, $allowedFolders)) {
        return back()->with('error', 'Invalid folder.');
    }

    $filePath = public_path($request->folder . '/' . $request->filename);

    if (File::exists($filePath)) {
        File::delete($filePath);
        return back()->with('success', 'Image deleted successfully!');
    }

    return back()->with('error', 'File not found.');
}
}
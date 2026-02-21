<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Post;
use App\Models\Profile;

class ProfileController extends Controller
{
    // ==============================
    // HALAMAN AKUN
    // ==============================
    public function index()
    {
        $user = Auth::user();

        // Pastikan profile ada
        $profile = Profile::firstOrCreate([
            'user_id' => $user->id
        ]);

        // Ambil semua post user
        $posts = Post::where('user_id', $user->id)
            ->latest()
            ->get();

        // Ambil semua gambar dari folder public/images (opsional FYP style)
        $images = [];
        $path = public_path('images');

        if (File::exists($path)) {
            foreach (File::files($path) as $file) {
                $images[] = asset('images/' . $file->getFilename());
            }
        }

        return view('akun.akun', compact('user', 'profile', 'posts', 'images'));
    }


    // ==============================
    // FORM EDIT AKUN
    // ==============================
    public function edit()
    {
        $user = Auth::user();

        $profile = Profile::firstOrCreate([
            'user_id' => $user->id
        ]);

        return view('akun.edit', compact('user', 'profile'));
    }


    // ==============================
    // UPDATE AKUN
    // ==============================
public function update(Request $request)
{
    $request->validate([
        'avatar'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'status'   => 'nullable|string|max:255',
        'location' => 'nullable|string|max:255',
    ]);

    $user = Auth::user();

    $profile = Profile::firstOrCreate([
        'user_id' => $user->id
    ]);

    if ($request->hasFile('avatar')) {

        if ($profile->avatar && file_exists(public_path('profile/'.$profile->avatar))) {
            unlink(public_path('profile/'.$profile->avatar));
        }

        $file = $request->file('avatar');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('profile'), $filename);

        $profile->avatar = $filename;
    }

    $profile->status   = $request->status;
    $profile->location = $request->location;
    $profile->save();

    return redirect()->route('akun')->with('success','Akun berhasil diperbarui!');
}

    // ==============================
    // UPLOAD IMAGE
    // ==============================
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:20480',
        ]);

        $path = public_path('images');

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $file = $request->file('image');
        $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
        $file->move($path, $filename);

        Post::create([
            'user_id' => Auth::id(),
            'image'   => $filename,
        ]);

        return redirect()->route('akun')->with('success','Gambar berhasil diunggah!');
    }


    // ==============================
    // DELETE IMAGE
    // ==============================
    public function deleteImage($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id !== Auth::id()) {
            return back()->with('error','Aksi tidak diizinkan.');
        }

        $filePath = public_path('images/'.$post->image);

        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        $post->delete();

        return back()->with('success','Gambar berhasil dihapus!');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    protected $imagePath = 'images';


    // =====================================================
    // DASHBOARD / GALERI PUBLIK
    // =====================================================

    public function index()
    {
        $images = Post::with('user')
            ->withCount(['likes', 'comments'])
            ->latest()
            ->get();

        return view(
            'dashboard.dashboard',
            compact('images')
        );
    }


    // =====================================================
    // FORM UPLOAD
    // =====================================================

    public function create()
    {
        return view('dashboard.upload');
    }


    // =====================================================
    // PROSES UPLOAD
    // =====================================================

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:20480',
            'title' => 'required|string|max:255',
        ]);

        // Pastikan folder public/images ada
        $path = public_path($this->imagePath);

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        // Ambil file
        $file = $request->file('image');

        // Buat nama file unik
        $filename = time()
            . '_'
            . uniqid()
            . '.'
            . $file->getClientOriginalExtension();

        // Simpan file
        $file->move($path, $filename);

        // Simpan database
        Post::create([
            'user_id' => Auth::id(),
            'image'   => $filename,
            'title'   => $request->input('title'),
        ]);

        return redirect()
            ->route('akun')
            ->with(
                'success',
                'Image uploaded successfully!'
            );
    }


    // =====================================================
    // DELETE IMAGE DARI DATABASE / GALERI
    // =====================================================

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Hanya pemilik yang boleh menghapus
        if ($post->user_id !== Auth::id()) {
            return back()
                ->with(
                    'error',
                    'Unauthorized action.'
                );
        }

        // Lokasi file
        $filePath = public_path(
            $this->imagePath . '/' . $post->image
        );

        // Hapus file
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        // Hapus database
        $post->delete();

        return back()
            ->with(
                'success',
                'Image deleted successfully.'
            );
    }


    // =====================================================
    // DETAIL IMAGE
    // =====================================================

    public function show($id)
    {
        $post = Post::with('user')
            ->withCount(['likes', 'comments'])
            ->findOrFail($id);

        // Cek apakah user sedang login dan sudah like
        $liked = false;

        if (Auth::check()) {

            $liked = DB::table('likes')
                ->where('post_id', $post->id)
                ->where('user_id', Auth::id())
                ->exists();
        }

        // Ambil semua comment
        $comments = DB::table('comments')
            ->join(
                'users',
                'comments.user_id',
                '=',
                'users.id'
            )
            ->where(
                'comments.post_id',
                $post->id
            )
            ->select(
                'comments.*',
                'users.name as user_name'
            )
            ->latest('comments.created_at')
            ->get();

        return view(
            'gallery.show',
            compact(
                'post',
                'liked',
                'comments'
            )
        );
    }


    // =====================================================
    // LIKE / UNLIKE
    // =====================================================

    public function like($id)
    {
        // Pastikan user login
        if (!Auth::check()) {
            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Please login first.'
                );
        }

        $post = Post::findOrFail($id);

        // Cek apakah sudah like
        $existingLike = DB::table('likes')
            ->where('post_id', $post->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingLike) {

            // UNLIKE
            DB::table('likes')
                ->where('id', $existingLike->id)
                ->delete();

            return back()
                ->with(
                    'success',
                    'Like removed.'
                );
        }

        // LIKE
        DB::table('likes')->insert([
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()
            ->with(
                'success',
                'Post liked!'
            );
    }


    // =====================================================
    // TAMBAH COMMENT
    // =====================================================

    public function comment(
        Request $request,
        $id
    ) {
        // Pastikan login
        if (!Auth::check()) {
            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Please login first.'
                );
        }

        $request->validate([
            'comment' =>
                'required|string|max:1000',
        ]);

        $post = Post::findOrFail($id);

        // Cek apakah pemilik mengizinkan comment
        if (!$post->allow_comment) {

            return back()
                ->with(
                    'error',
                    'Comments are disabled for this post.'
                );
        }

        // Simpan comment
        DB::table('comments')->insert([
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'comment' => $request->input('comment'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()
            ->with(
                'success',
                'Comment added successfully!'
            );
    }


    // =====================================================
    // DELETE COMMENT
    // =====================================================

    public function deleteComment($id)
    {
        if (!Auth::check()) {
            return redirect()
                ->route('login');
        }

        // Cari comment
        $comment = DB::table('comments')
            ->where('id', $id)
            ->first();

        if (!$comment) {
            return back()
                ->with(
                    'error',
                    'Comment not found.'
                );
        }

        // Hanya pemilik comment
        // yang boleh menghapus
        if ($comment->user_id !== Auth::id()) {

            return back()
                ->with(
                    'error',
                    'Unauthorized action.'
                );
        }

        DB::table('comments')
            ->where('id', $id)
            ->delete();

        return back()
            ->with(
                'success',
                'Comment deleted successfully.'
            );
    }


    // =====================================================
    // HALAMAN USER AKUN
    // =====================================================

    public function akun()
    {
        $images = Post::where(
            'user_id',
            Auth::id()
        )
        ->withCount([
            'likes',
            'comments'
        ])
        ->latest()
        ->get();

        return view(
            'akun.akun',
            compact('images')
        );
    }


    // =====================================================
    // TRENDING
    // =====================================================

    public function trending()
    {
        $images = Post::with('user')
            ->withCount([
                'likes',
                'comments'
            ])
            ->latest()
            ->get();

        $trendingPath = public_path('trending');

        $trendingImages = [];

        if (File::exists($trendingPath)) {

            $files = File::files(
                $trendingPath
            );

            foreach ($files as $file) {

                $trendingImages[] = asset(
                    'trending/' .
                    $file->getFilename()
                );
            }
        }

        return view(
            'jelajah.jelajah',
            compact(
                'images',
                'trendingImages'
            )
        );
    }


    // =====================================================
    // HALAMAN JELAJAH - ANIME
    // =====================================================

    public function anime()
    {
        return $this->loadImages(
            'anime',
            'jelajah.anime'
        );
    }


    // =====================================================
    // HALAMAN JELAJAH - PHOTOGRAPHY
    // =====================================================

    public function photography()
    {
        return $this->loadImages(
            'photography',
            'jelajah.photography'
        );
    }


    // =====================================================
    // HALAMAN JELAJAH - ART
    // =====================================================

    public function art()
    {
        return $this->loadImages(
            'art',
            'jelajah.art'
        );
    }


    // =====================================================
    // HALAMAN JELAJAH - MEMES
    // =====================================================

    public function memes()
    {
        return $this->loadImages(
            'memes',
            'jelajah.meme'
        );
    }


    // =====================================================
    // LOAD IMAGE DARI FOLDER
    // =====================================================

    private function loadImages(
        $folder,
        $viewName
    ) {
        $path = public_path($folder);

        $images = [];

        if (File::exists($path)) {

            $files = File::files($path);

            foreach ($files as $file) {

                $images[] = asset(
                    $folder .
                    '/' .
                    $file->getFilename()
                );
            }
        }

        return view(
            $viewName,
            compact('images')
        );
    }


    // =====================================================
    // DELETE IMAGE DARI FOLDER
    // =====================================================

    public function deleteFolderImage(
        Request $request
    ) {
        $request->validate([
            'folder' =>
                'required|string',

            'filename' =>
                'required|string',
        ]);

        // Folder yang diperbolehkan
        $allowedFolders = [
            'anime',
            'photography',
            'art',
            'memes',
            'meme',
            'trending',
            'images',
            'post',
        ];

        // Cegah akses folder lain
        if (
            !in_array(
                $request->folder,
                $allowedFolders
            )
        ) {

            return back()
                ->with(
                    'error',
                    'Invalid folder.'
                );
        }

        // Path file
        $filePath = public_path(
            $request->folder .
            '/' .
            $request->filename
        );

        // Hapus file
        if (File::exists($filePath)) {

            File::delete($filePath);

            return back()
                ->with(
                    'success',
                    'Image deleted successfully!'
                );
        }

        return back()
            ->with(
                'error',
                'File not found.'
            );
    }
}

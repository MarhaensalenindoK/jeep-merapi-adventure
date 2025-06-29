<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class BlogController extends Controller
{
    /**
     * Halaman daftar artikel blog
     */
    public function index(Request $request)
    {
        $query = Post::with('author')->where('is_published', true);

        // Filter berdasarkan pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('body', 'like', "%{$search}%");
            });
        }

        $posts = $query->orderBy('updated_at', 'desc')->paginate(10);

        return view('public.blog.index', compact('posts'));
    }

    /**
     * Halaman detail artikel blog
     */
    public function show(Post $post)
    {
        // Pastikan artikel sudah dipublish
        if (!$post->is_published) {
            abort(404);
        }

        // Artikel terkait
        $relatedPosts = Post::where('is_published', true)
            ->where('id', '!=', $post->id)
            ->orderBy('updated_at', 'desc')
            ->take(3)
            ->get();

        return view('public.blog.show', compact('post', 'relatedPosts'));
    }
}

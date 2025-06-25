<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Post::with(['author']);

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('body', 'like', "%{$searchTerm}%")
                  ->orWhere('slug', 'like', "%{$searchTerm}%")
                  ->orWhereHas('author', function ($authorQuery) use ($searchTerm) {
                      $authorQuery->where('name', 'like', "%{$searchTerm}%");
                  });
            });
        }

        // Filter by author
        if ($request->filled('author_id')) {
            $query->where('user_id', $request->author_id);
        }

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'published') {
                $query->whereNotNull('published_at');
            } elseif ($request->status === 'draft') {
                $query->whereNull('published_at');
            }
        }

        // Sorting
        $sortField = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');

        $allowedSortFields = ['title', 'created_at', 'published_at', 'updated_at'];
        if (in_array($sortField, $allowedSortFields)) {
            $query->orderBy($sortField, $sortDirection);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $posts = $query->paginate(15)->appends($request->query());

        // Get authors for filter dropdown
        $authors = User::whereHas('posts')->orderBy('name')->get();

        return view('admin.posts.index', compact('posts', 'authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = User::orderBy('name')->get();
        return view('admin.posts.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug',
            'body' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:15360', // 15MB
            'published_at' => 'nullable|date',
            'is_published' => 'boolean',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        // Ensure slug uniqueness
        $originalSlug = $validated['slug'];
        $counter = 1;
        while (Post::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Handle published_at
        if ($request->boolean('is_published') && !$request->filled('published_at')) {
            $validated['published_at'] = now();
        } elseif (!$request->boolean('is_published')) {
            $validated['published_at'] = null;
        }

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('posts', 'public');
            $validated['featured_image'] = $path;
        }

        // Add audit fields
        $validated['created_by'] = Auth::id();
        $validated['updated_by'] = Auth::id();

        $post = Post::create($validated);

        return redirect()->route('admin.posts.index')
                        ->with('success', 'Artikel berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // Load basic relationship
        $post->load(['author']);

        // Load audit relationships if they exist
        if ($post->created_by) {
            $post->load('createdByUser');
        }
        if ($post->updated_by) {
            $post->load('updatedByUser');
        }

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Load basic relationship
        $post->load(['author']);

        // Load audit relationships if they exist
        if ($post->created_by) {
            $post->load('createdByUser');
        }
        if ($post->updated_by) {
            $post->load('updatedByUser');
        }

        $authors = User::orderBy('name')->get();
        return view('admin.posts.edit', compact('post', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('posts', 'slug')->ignore($post->id)],
            'body' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:15360', // 15MB
            'published_at' => 'nullable|date',
            'is_published' => 'boolean',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        // Ensure slug uniqueness (excluding current post)
        $originalSlug = $validated['slug'];
        $counter = 1;
        while (Post::where('slug', $validated['slug'])->where('id', '!=', $post->id)->exists()) {
            $validated['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Handle published_at
        if ($request->boolean('is_published') && !$request->filled('published_at')) {
            $validated['published_at'] = $post->published_at ?? now();
        } elseif (!$request->boolean('is_published')) {
            $validated['published_at'] = null;
        }

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($post->featured_image && Storage::disk('public')->exists($post->featured_image)) {
                Storage::disk('public')->delete($post->featured_image);
            }

            $path = $request->file('featured_image')->store('posts', 'public');
            $validated['featured_image'] = $path;
        }

        // Add audit field
        $validated['updated_by'] = Auth::id();

        $post->update($validated);

        return redirect()->route('admin.posts.index')
                        ->with('success', 'Artikel berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        try {
            // Delete featured image if exists
            if ($post->featured_image && Storage::disk('public')->exists($post->featured_image)) {
                Storage::disk('public')->delete($post->featured_image);
            }

            $post->delete();

            return redirect()->route('admin.posts.index')
                           ->with('success', 'Artikel berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('admin.posts.index')
                           ->with('error', 'Gagal menghapus artikel: ' . $e->getMessage());
        }
    }
}

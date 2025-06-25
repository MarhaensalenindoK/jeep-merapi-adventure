<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Gallery::with(['package', 'createdByUser']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('caption', 'like', "%{$search}%")
                  ->orWhereHas('package', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by package
        if ($request->filled('package_id')) {
            $query->where('package_id', $request->package_id);
        }

        // Filter by featured
        if ($request->filled('is_featured')) {
            $query->where('is_featured', $request->is_featured);
        }

        // Sorting
        $sortField = $request->get('sort', 'sort_order');
        $sortDirection = $request->get('direction', 'asc');

        $validSortFields = ['title', 'sort_order', 'is_featured', 'created_at'];
        if (!in_array($sortField, $validSortFields)) {
            $sortField = 'sort_order';
        }

        $query->orderBy($sortField, $sortDirection);

        $galleries = $query->paginate(10)->appends($request->query());

        // Get packages for filter dropdown
        $packages = Package::orderBy('name')->get();

        return view('admin.galleries.index', compact('galleries', 'packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $packages = Package::orderBy('name')->get();

        // Get the next sort order number
        $nextSortOrder = Gallery::max('sort_order') + 1;

        return view('admin.galleries.create', compact('packages', 'nextSortOrder'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:15360', // 15MB = 15360KB
            'alt_text' => 'nullable|string|max:255',
            'package_id' => 'nullable|exists:packages,id',
            'sort_order' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('galleries', 'public');
        }

        Gallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $imagePath,
            'alt_text' => $request->alt_text,
            'package_id' => $request->package_id,
            'sort_order' => $request->sort_order ?? 0,
            'is_featured' => $request->boolean('is_featured'),
            'caption' => $request->title, // backward compatibility
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('admin.galleries.index')
                        ->with('success', 'Galeri berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        $gallery->load(['package', 'createdByUser', 'updatedByUser']);

        // Get next and previous galleries in the same package
        $nextGallery = Gallery::where('package_id', $gallery->package_id)
                             ->where('sort_order', '>', $gallery->sort_order)
                             ->orderBy('sort_order', 'asc')
                             ->first();

        $prevGallery = Gallery::where('package_id', $gallery->package_id)
                             ->where('sort_order', '<', $gallery->sort_order)
                             ->orderBy('sort_order', 'desc')
                             ->first();

        return view('admin.galleries.show', compact('gallery', 'nextGallery', 'prevGallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        $packages = Package::orderBy('name')->get();

        // Get the highest sort order number (excluding current gallery)
        $maxSortOrder = Gallery::where('id', '!=', $gallery->id)->max('sort_order') ?? 0;

        return view('admin.galleries.edit', compact('gallery', 'packages', 'maxSortOrder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:15360', // 15MB = 15360KB
            'alt_text' => 'nullable|string|max:255',
            'package_id' => 'nullable|exists:packages,id',
            'sort_order' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
        ]);

        $updateData = [
            'title' => $request->title,
            'description' => $request->description,
            'alt_text' => $request->alt_text,
            'package_id' => $request->package_id,
            'sort_order' => $request->sort_order ?? 0,
            'is_featured' => $request->boolean('is_featured'),
            'caption' => $request->title, // backward compatibility
            'updated_by' => Auth::id(),
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($gallery->image_path) {
                Storage::disk('public')->delete($gallery->image_path);
            }

            $updateData['image_path'] = $request->file('image')->store('galleries', 'public');
        }

        $gallery->update($updateData);

        return redirect()->route('admin.galleries.index')
                        ->with('success', 'Galeri berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        // Delete image file
        if ($gallery->image_path) {
            Storage::disk('public')->delete($gallery->image_path);
        }

        $gallery->delete();

        return redirect()->route('admin.galleries.index')
                        ->with('success', 'Galeri berhasil dihapus!');
    }
}

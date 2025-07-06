<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PackageCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PackageCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PackageCategory::withCount('packages')->with('createdByUser');

        // 1. Logika Pencarian (Server-side)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // 2. Logika Sorting
        $sortBy = $request->input('sort', 'created_at');
        $sortDirection = $request->input('direction', 'desc');

        $allowedSorts = ['name', 'created_at', 'packages_count'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortDirection);
        }

        // 3. Logika Pagination
        $categories = $query->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Gunakan validated() untuk keamanan
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:package_categories',
            'description' => 'nullable|string',
        ], [
            'name.required' => 'Mohon isi Nama Kategori',
            'name.unique'   => 'Nama kategori sudah digunakan',
        ]);

        // Tambahkan slug dan user id secara otomatis
        $validatedData['slug'] = Str::slug($validatedData['name']);
        $validatedData['created_by'] = Auth::id();
        $validatedData['updated_by'] = Auth::id();

        PackageCategory::create($validatedData);

        return redirect()->route('admin.categories.index')
                        ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PackageCategory $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PackageCategory $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PackageCategory $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:package_categories,name,' . $category->id,
            'description' => 'nullable|string',
        ], [
            'name.required' => 'Mohon isi Nama Kategori',
            'name.unique'   => 'Nama kategori sudah digunakan',
        ]);

        // Tambahkan slug dan user id yang mengupdate
        $validatedData['slug'] = Str::slug($validatedData['name']);
        $validatedData['updated_by'] = Auth::id();

        $category->update($validatedData);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PackageCategory $category)
    {
        // Check if category has packages
        if ($category->packages()->count() > 0) {
            return redirect()->route('admin.categories.index')
            ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki paket.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}

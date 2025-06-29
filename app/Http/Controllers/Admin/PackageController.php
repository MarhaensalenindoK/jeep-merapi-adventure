<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Package::with(['category', 'createdByUser', 'galleries']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('routes', 'like', "%{$search}%")
                  ->orWhere('full_description', 'like', "%{$search}%")
                  ->orWhereHas('category', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('package_category_id', $request->category);
        }

        // Filter by price range
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // Sorting
        $sortField = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');

        $allowedSorts = ['name', 'price', 'duration', 'created_at', 'category_name'];
        if (in_array($sortField, $allowedSorts)) {
            if ($sortField === 'category_name') {
                $query->join('package_categories', 'packages.package_category_id', '=', 'package_categories.id')
                      ->orderBy('package_categories.name', $sortDirection)
                      ->select('packages.*');
            } else {
                $query->orderBy($sortField, $sortDirection);
            }
        }

        $packages = $query->paginate(10);
        $categories = PackageCategory::orderBy('name')->get();

        return view('admin.packages.index', compact('packages', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = PackageCategory::orderBy('name')->get();
        return view('admin.packages.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'package_category_id' => 'required|exists:package_categories,id',
            'name' => 'required|string|max:255|unique:packages,name',
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0',
            'duration' => 'required|string|max:255',
            'routes' => 'required|string',
            'full_description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $package = Package::create([
            'package_category_id' => $request->package_category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'duration' => $request->duration,
            'routes' => $request->routes,
            'full_description' => $request->full_description,
            'is_active' => $request->boolean('is_active'),
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        $package->load(['category', 'createdByUser', 'updatedByUser', 'galleries']);
        return view('admin.packages.show', compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        $categories = PackageCategory::orderBy('name')->get();
        return view('admin.packages.edit', compact('package', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Package $package)
    {
        $request->validate([
            'package_category_id' => 'required|exists:package_categories,id',
            'name' => 'required|string|max:255|unique:packages,name,' . $package->id,
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0',
            'duration' => 'required|string|max:255',
            'routes' => 'required|string',
            'full_description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $package->update([
            'package_category_id' => $request->package_category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'duration' => $request->duration,
            'routes' => $request->routes,
            'full_description' => $request->full_description,
            'is_active' => $request->boolean('is_active'),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        $package->delete();

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket berhasil dihapus!');
    }
}

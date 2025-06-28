<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\PackageCategory;

class PublicPackageController extends Controller
{
    /**
     * Halaman daftar semua paket
     */
    public function index(Request $request)
    {
        $query = Package::where('is_active', true)->with(['category', 'galleries']);

        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter berdasarkan pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $packages = $query->orderBy('created_at', 'desc')->paginate(12);
        $categories = PackageCategory::where('is_active', true)->orderBy('name')->get();

        return view('public.packages.index', compact('packages', 'categories'));
    }

    /**
     * Halaman detail paket
     */
    public function show(Package $package)
    {
        // Pastikan paket aktif
        if (!$package->is_active) {
            abort(404);
        }

        $package->load(['category', 'galleries' => function ($query) {
            $query->orderBy('sort_order');
        }]);

        // Paket terkait dari kategori yang sama
        $relatedPackages = Package::where('is_active', true)
            ->where('id', '!=', $package->id)
            ->where('package_category_id', $package->package_category_id)
            ->with(['category', 'galleries'])
            ->take(4)
            ->get();

        return view('public.packages.show', compact('package', 'relatedPackages'));
    }
}

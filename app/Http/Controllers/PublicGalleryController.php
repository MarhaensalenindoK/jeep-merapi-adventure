<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Package;

class PublicGalleryController extends Controller
{
    /**
     * Halaman galeri publik
     */
    public function index(Request $request)
    {
        $query = Gallery::query()->with('package');

        // Filter berdasarkan paket
        if ($request->filled('package')) {
            $query->whereHas('package', function ($q) use ($request) {
                $q->where('slug', $request->package);
            });
        }

        // Filter hanya yang featured
        if ($request->filled('featured')) {
            $query->where('is_featured', true);
        }

        $galleries = $query->orderBy('sort_order')
                          ->orderBy('created_at', 'desc')
                          ->paginate(20);

        $packages = Package::where('is_active', true)
                          ->whereHas('galleries')
                          ->orderBy('name')
                          ->get();

        return view('public.gallery.index', compact('galleries', 'packages'));
    }
}

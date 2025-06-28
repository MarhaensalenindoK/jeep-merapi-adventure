<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Gallery;
use App\Models\Post;
use App\Models\PackageCategory;

class HomeController extends Controller
{
    /**
     * Halaman Beranda
     */
    public function index()
    {
        // Ambil data untuk homepage
        $featuredPackages = Package::where('is_active', true)
            ->with(['category', 'galleries'])
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        $featuredGalleries = Gallery::where('is_featured', true)
            ->with('package')
            ->orderBy('sort_order')
            ->take(8)
            ->get();

        // Fallback jika tidak ada galeri featured
        if ($featuredGalleries->isEmpty()) {
            $featuredGalleries = Gallery::with('package')
                ->orderBy('created_at', 'desc')
                ->take(8)
                ->get();
        }

        $latestPosts = Post::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('public.home', compact('featuredPackages', 'featuredGalleries', 'latestPosts'));
    }

    /**
     * Halaman Tentang Kami
     */
    public function about()
    {
        return view('public.about');
    }

    /**
     * Halaman Kontak
     */
    public function contact()
    {
        // Ambil data packages untuk dropdown
        $packages = Package::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('public.contact', compact('packages'));
    }

    /**
     * Proses form kontak
     */
    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|max:1000',
        ]);

        // TODO: Implement contact form submission (email, database, etc.)

        return back()->with('success', 'Pesan Anda berhasil dikirim! Kami akan segera merespon.');
    }
}

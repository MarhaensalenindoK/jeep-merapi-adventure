<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageCategory;
use App\Models\Gallery;
use App\Models\Post;

class DashboardController extends Controller
{
    public function index()
    {
        // Mendapatkan statistik untuk dashboard
        $stats = [
            'categories' => PackageCategory::count(),
            'packages' => Package::count(),
            'galleries' => Gallery::count(),
            'posts' => Post::count(),
        ];

        // Mendapatkan data terbaru untuk ditampilkan di dashboard
        $recentPackages = Package::latest()->take(5)->get();
        $recentPosts = Post::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentPackages', 'recentPosts'));
    }
}

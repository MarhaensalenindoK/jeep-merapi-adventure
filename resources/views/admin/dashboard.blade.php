@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Welcome Card -->
    <div class="admin-card">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-admin-primary rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                    </svg>
                </div>
            </div>
            <div class="ml-4">
                <h2 class="text-2xl font-bold text-gray-900">Selamat Datang, {{ Auth::user()->name }}!</h2>
                <p class="text-lg text-gray-600">Kelola sistem Jeep Merapi Adventure dengan mudah</p>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Categories -->
        <div class="admin-card">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-admin-secondary rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Kategori</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['categories'] }}</p>
                </div>
            </div>
        </div>

        <!-- Total Packages -->
        <div class="admin-card">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-admin-accent rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-admin-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Paket</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['packages'] }}</p>
                </div>
            </div>
        </div>

        <!-- Total Galleries -->
        <div class="admin-card">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-admin-primary rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Galeri</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['galleries'] }}</p>
                </div>
            </div>
        </div>

        <!-- Total Posts -->
        <div class="admin-card">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-admin-secondary rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Blog</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['posts'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="admin-card">
        <h3 class="text-xl font-bold text-gray-900 mb-4">Aksi Cepat</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('admin.categories.create') }}" class="admin-btn-primary text-center">
                + Tambah Kategori
            </a>
            <a href="{{ route('admin.packages.create') }}" class="admin-btn-primary text-center">
                + Tambah Paket
            </a>
            <a href="{{ route('admin.galleries.create') }}" class="admin-btn-primary text-center">
                + Tambah Galeri
            </a>
            <a href="{{ route('admin.posts.create') }}" class="admin-btn-primary text-center">
                + Tambah Blog
            </a>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Packages -->
        <div class="admin-card">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Paket Terbaru</h3>
            <div class="space-y-3">
                @forelse($recentPackages as $package)
                    <a href="{{ route('admin.packages.show', $package) }}" class="block p-3 bg-gray-50 rounded-lg hover:bg-gray-100 hover:shadow-md transition-all duration-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-semibold text-gray-900">{{ $package->name }}</p>
                                <p class="text-sm text-gray-600">{{ $package->created_at ? $package->created_at->format('d M Y') : '-' }}</p>
                            </div>
                            <span class="admin-badge {{ $package->is_active ? 'admin-badge-success' : 'admin-badge-danger' }}">{{ $package->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                        </div>
                    </a>
                @empty
                    <p class="text-gray-500 text-center py-4">Belum ada paket</p>
                @endforelse
            </div>
        </div>

        <!-- Recent Posts -->
        <div class="admin-card">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Blog Terbaru</h3>
            <div class="space-y-3">
                @forelse($recentPosts as $post)
                     <a href="{{ route('admin.posts.show', $post) }}" class="block p-3 bg-gray-50 rounded-lg hover:bg-gray-100 hover:shadow-md transition-all duration-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-semibold text-gray-900">{{ $post->title }}</p>
                                <p class="text-sm text-gray-600">{{ $post->created_at ? $post->created_at->format('d M Y') : '-' }}</p>
                            </div>
                            <span class="admin-badge {{ $post->is_published ? 'admin-badge-success' : 'admin-badge-warning' }}">{{ $post->is_published ? 'Published' : 'Draft' }}</span>
                        </div>
                    </a>
                @empty
                    <p class="text-gray-500 text-center py-4">Belum ada blog</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

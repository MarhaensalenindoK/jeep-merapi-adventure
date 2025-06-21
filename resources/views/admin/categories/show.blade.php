@extends('layouts.admin.app')

@section('title', 'Detail Kategori')

@php
    $breadcrumbs = [
        ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['title' => 'Manajemen Kategori', 'url' => route('admin.categories.index')],
        ['title' => 'Detail Kategori'],
    ];
@endphp

@section('header-actions')
    <div class="flex items-center space-x-3">
        <a href="{{ route('admin.categories.edit', $category) }}" class="admin-btn-primary">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Edit Kategori
        </a>
    </div>
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header Info -->
    <div class="admin-card">
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <h1 class="text-xl font-bold text-gray-900 mb-2">{{ $category->name }}</h1>
                <p class="text-sm text-gray-600">{{ $category->description ?: 'Tidak ada deskripsi' }}</p>
                <div class="mt-4 flex items-center space-x-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-admin-light text-admin-primary">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        {{ $category->slug }}
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        {{ $category->packages()->count() }} Paket
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Information Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Audit Information -->
        <div class="admin-card">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Informasi Audit</h3>
            <div class="space-y-4">
                <div class="border-b border-gray-100 pb-3">
                    <dt class="text-sm font-medium text-gray-500">Dibuat oleh</dt>
                    <dd class="mt-1 text-lg text-gray-900">{{ $category->createdByUser->name ?? 'Sistem' }}</dd>
                </div>
                <div class="border-b border-gray-100 pb-3">
                    <dt class="text-sm font-medium text-gray-500">Tanggal dibuat</dt>
                    <dd class="mt-1 text-lg text-gray-900">{{ $category->created_at->format('d F Y, H:i') }}</dd>
                </div>
                @if($category->updatedByUser)
                    <div class="border-b border-gray-100 pb-3">
                        <dt class="text-sm font-medium text-gray-500">Terakhir diubah oleh</dt>
                        <dd class="mt-1 text-lg text-gray-900">{{ $category->updatedByUser->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Tanggal diubah</dt>
                        <dd class="mt-1 text-lg text-gray-900">{{ $category->updated_at->format('d F Y, H:i') }}</dd>
                    </div>
                @endif
            </div>
        </div>

        <!-- Category Statistics -->
        <div class="admin-card">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Statistik</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-admin-light rounded-lg">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Paket</p>
                        <p class="text-2xl font-bold text-admin-primary">{{ $category->packages()->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-admin-primary rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                </div>

                @if($category->packages()->exists())
                    <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Paket Terbaru</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $category->packages()->latest()->first()->name ?? '-' }}</p>
                        </div>
                        <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Packages List -->
    @if($category->packages()->exists())
        <div class="admin-card">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-900">Paket dalam Kategori Ini</h3>
                <a href="{{ route('admin.packages.create', ['category' => $category->id]) }}" class="admin-btn-secondary">
                    + Tambah Paket
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Nama Paket</th>
                            <th>Durasi</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Tanggal Dibuat</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($category->packages()->latest()->limit(10)->get() as $package)
                            <tr>
                                <td>
                                    <div class="font-semibold text-gray-900">{{ $package->name }}</div>
                                    <div class="text-sm text-gray-500">{{ Str::limit($package->description, 50) }}</div>
                                </td>
                                <td class="text-gray-600">{{ $package->duration ?? '-' }}</td>
                                <td class="font-semibold text-admin-primary">
                                    {{ $package->price ? 'Rp ' . number_format($package->price, 0, ',', '.') : '-' }}
                                </td>
                                <td>
                                    <span class="admin-badge admin-badge-success">Aktif</span>
                                </td>
                                <td class="text-gray-600">{{ $package->created_at->format('d M Y') }}</td>
                                <td class="text-right">
                                    <a href="{{ route('admin.packages.show', $package) }}"
                                       class="text-admin-primary hover:text-admin-secondary">
                                        Lihat
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($category->packages()->count() > 10)
                <div class="mt-4 text-center">
                    <a href="{{ route('admin.packages.index', ['category' => $category->id]) }}"
                       class="text-admin-primary hover:text-admin-secondary font-medium">
                        Lihat semua paket ({{ $category->packages()->count() }})
                    </a>
                </div>
            @endif
        </div>
    @else
        <div class="admin-card">
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Paket</h3>
                <p class="text-gray-600 mb-6">Kategori ini belum memiliki paket wisata. Tambahkan paket pertama untuk kategori ini.</p>
                <a href="{{ route('admin.packages.create', ['category' => $category->id]) }}" class="admin-btn-primary">
                    + Tambah Paket Pertama
                </a>
            </div>
        </div>
    @endif

    <!-- Actions -->
    <div class="admin-card" x-data="{ showDeleteModal: false }">
        <div class="flex items-center justify-between">
            <h3 class="text-xl font-bold text-gray-900">Aksi</h3>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.categories.edit', $category) }}" class="admin-btn-secondary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Kategori
                </a>

                @if($category->packages()->count() == 0)
                    <button @click="showDeleteModal = true" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Hapus Kategori
                    </button>
                @else
                    <div class="text-sm text-gray-500 bg-gray-100 px-3 py-2 rounded-lg">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Kategori tidak dapat dihapus karena masih memiliki paket
                    </div>
                @endif
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div x-show="showDeleteModal"
             x-transition.opacity.duration.300ms
             class="fixed inset-0 z-50 overflow-y-auto"
             style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">

                <!-- Background overlay -->
                <div x-show="showDeleteModal"
                     x-transition.opacity.duration.300ms
                     @click="showDeleteModal = false"
                     class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"
                     aria-hidden="true"></div>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <!-- Modal panel -->
                <div x-show="showDeleteModal"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="inline-block w-full max-w-sm p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl sm:max-w-md">

                    <!-- Header with icon and close button -->
                    <div class="flex items-start justify-between">
                        <div class="flex items-center">
                            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">
                                    Hapus Kategori
                                </h3>
                            </div>
                        </div>
                        <button @click="showDeleteModal = false"
                                class="text-gray-400 hover:text-gray-600 focus:outline-none">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Content -->
                    <div class="mt-4">
                        <p class="text-sm text-gray-500 text-wrap">
                            Apakah Anda yakin ingin menghapus kategori <span class="font-medium text-gray-900">"{{ $category->name }}"</span>?
                            Tindakan ini tidak dapat dibatalkan.
                        </p>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col-reverse gap-3 mt-6 sm:flex-row sm:justify-end">
                        <button @click="showDeleteModal = false"
                                type="button"
                                class="w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-admin-primary sm:w-auto">
                            Batal
                        </button>
                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="w-full sm:w-auto">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="w-full px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:w-auto">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

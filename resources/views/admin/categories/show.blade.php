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
        <x-button variant="primary" icon="edit" :href="route('admin.categories.edit', $category)">
            Edit Kategori
        </x-button>
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
                    <dd class="mt-1 text-lg text-gray-900">{{ $category->created_at ? $category->created_at->format('d F Y, H:i') : '-' }}</dd>
                </div>
                @if($category->updatedByUser)
                    <div class="border-b border-gray-100 pb-3">
                        <dt class="text-sm font-medium text-gray-500">Terakhir diubah oleh</dt>
                        <dd class="mt-1 text-lg text-gray-900">{{ $category->updatedByUser->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Tanggal diubah</dt>
                        <dd class="mt-1 text-lg text-gray-900">{{ $category->updated_at ? $category->updated_at->format('d F Y, H:i') : '-' }}</dd>
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
                <x-button variant="secondary" icon="plus" :href="route('admin.packages.create', ['category' => $category->id])">
                    Tambah Paket
                </x-button>
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
                                <td class="text-gray-600">{{ $package->created_at ? $package->created_at->format('d M Y') : '-' }}</td>
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
                <x-button variant="primary" icon="plus" :href="route('admin.packages.create', ['category' => $category->id])">
                    Tambah Paket Pertama
                </x-button>
            </div>
        </div>
    @endif

    <!-- Actions -->
    <div class="admin-card" x-data="{ showDeleteModal: false }">
        <div class="flex items-center justify-between">
            <h3 class="text-xl font-bold text-gray-900">Aksi</h3>
            <div class="flex items-center space-x-3">
                <x-button variant="secondary" icon="edit" :href="route('admin.categories.edit', $category)">
                    Edit Kategori
                </x-button>

                @if($category->packages()->count() == 0)
                    <x-button variant="danger" icon="delete" @click="showDeleteModal = true">
                        Hapus Kategori
                    </x-button>
                @else
                    <x-alert type="warning" class="inline-flex">
                        Kategori tidak dapat dihapus karena masih memiliki paket
                    </x-alert>
                @endif
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <x-delete-modal show="showDeleteModal" title="Hapus Kategori">
            <p>Apakah Anda yakin ingin menghapus kategori "<strong>{{ $category->name }}</strong>"?
            Tindakan ini tidak dapat dibatalkan.</p>

            <x-slot name="actions">
                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="w-full sm:w-auto">
                    @csrf
                    @method('DELETE')
                    <x-button type="submit" variant="danger" class="w-full sm:w-auto">
                        Hapus
                    </x-button>
                </form>
            </x-slot>
        </x-delete-modal>
    </div>
</div>
@endsection

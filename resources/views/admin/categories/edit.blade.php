@extends('layouts.admin.app')

@section('title', 'Edit Kategori')

@php
    $breadcrumbs = [
        ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['title' => 'Manajemen Kategori', 'url' => route('admin.categories.index')],
        ['title' => 'Edit Kategori'],
    ];
@endphp

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="admin-card">
        <div class="mb-6">
            <h2 class="text-lg font-bold text-gray-900">Edit Kategori</h2>
            <p class="text-gray-600 mt-2 text-sm">Perbarui informasi kategori paket wisata</p>
        </div>

        <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nama Kategori -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="name"
                       id="name"
                       class="admin-input @error('name') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                       value="{{ old('name', $category->name) }}"
                       placeholder="Contoh: Paket Keluarga"
                       required>
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-gray-500">
                    Slug akan dibuat otomatis: <strong id="slug-preview">{{ $category->slug }}</strong>
                </p>
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                    Deskripsi
                </label>
                <textarea name="description"
                          id="description"
                          rows="4"
                          class="admin-input @error('description') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                          placeholder="Deskripsi singkat tentang kategori ini...">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-gray-500">Deskripsi opsional untuk menjelaskan kategori ini</p>
            </div>

            <!-- Info Audit -->
            <div class="bg-gray-50 rounded-lg p-4">
                <h3 class="text-lg font-semibold text-gray-700 mb-3">Informasi</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-500">Dibuat oleh:</span>
                        <span class="font-medium text-gray-800">{{ $category->createdByUser->name ?? 'Sistem' }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Tanggal dibuat:</span>
                        <span class="font-medium text-gray-800">{{ $category->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    @if($category->updatedByUser)
                        <div>
                            <span class="text-gray-500">Terakhir diubah oleh:</span>
                            <span class="font-medium text-gray-800">{{ $category->updatedByUser->name }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Tanggal diubah:</span>
                            <span class="font-medium text-gray-800">{{ $category->updated_at->format('d M Y, H:i') }}</span>
                        </div>
                    @endif
                    <div>
                        <span class="text-gray-500">Total paket:</span>
                        <span class="font-medium text-admin-primary">{{ $category->packages()->count() }} paket</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('admin.categories.index') }}"
                   class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-lg font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-admin-primary transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Batal
                </a>
                <button type="submit"
                        class="admin-btn-primary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Perbarui Kategori
                </button>
            </div>
        </form>
    </div>

    <!-- Help Section -->
    <div class="admin-card mt-6 bg-admin-light border-admin-accent">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="w-6 h-6 text-admin-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-lg font-semibold text-admin-primary">Tips:</h3>
                <div class="mt-2 text-gray-700">
                    <ul class="list-disc list-inside space-y-1 text-base">
                        <li>Pastikan nama kategori tidak duplikat dengan yang sudah ada</li>
                        <li>Slug akan dibuat otomatis berdasarkan nama kategori</li>
                        <li>Jika kategori sudah memiliki paket, pertimbangkan dampak perubahan nama</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Update slug preview when name changes
    document.getElementById('name').addEventListener('input', function() {
        const name = this.value;
        const slug = name.toLowerCase()
            .replace(/[^a-z0-9 -]/g, '') // Remove invalid chars
            .replace(/\s+/g, '-')        // Replace spaces with -
            .replace(/-+/g, '-')         // Replace multiple - with single -
            .trim('-');                  // Trim - from ends

        document.getElementById('slug-preview').textContent = slug || 'nama-kategori';
    });
</script>
@endpush

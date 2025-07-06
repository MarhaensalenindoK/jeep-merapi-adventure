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
                    required
                    oninvalid="this.setCustomValidity('Mohon isi Nama Kategori')"
                    oninput="this.setCustomValidity('')">
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

            <!-- Is Active -->
            <div class="space-y-2">
                <div class="flex items-center">
                    <input type="checkbox" id="is_active" name="is_active" value="1"
                           class="h-4 w-4 text-admin-primary focus:ring-admin-primary border-gray-300 rounded"
                           {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                    <label for="is_active" class="ml-2 block text-sm font-medium text-gray-700">
                        Kategori Aktif
                    </label>
                </div>
                <p class="text-sm text-gray-500">Centang untuk mengaktifkan kategori di halaman publik</p>
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
                        <span class="font-medium text-gray-800">{{ $category->created_at ? $category->created_at->format('d M Y, H:i') : '-' }}</span>
                    </div>
                    @if($category->updatedByUser)
                        <div>
                            <span class="text-gray-500">Terakhir diubah oleh:</span>
                            <span class="font-medium text-gray-800">{{ $category->updatedByUser->name }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Tanggal diubah:</span>
                            <span class="font-medium text-gray-800">{{ $category->updated_at ? $category->updated_at->format('d M Y, H:i') : '-' }}</span>
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
                <x-button variant="outline" icon="arrow-left" :href="route('admin.categories.index')">
                    Batal
                </x-button>

                <x-button type="submit" variant="primary" icon="check">
                    Perbarui Kategori
                </x-button>
            </div>
        </form>
    </div>

    <!-- Help Section -->
    <x-alert type="info" class="mt-6">
        <div class="flex">
            <div class="ml-3">
                <h3 class="text-lg font-semibold text-blue-800">Tips:</h3>
                <div class="mt-2 text-blue-700">
                    <ul class="list-disc list-inside space-y-1 text-base">
                        <li>Pastikan nama kategori tidak duplikat dengan yang sudah ada</li>
                        <li>Slug akan dibuat otomatis berdasarkan nama kategori</li>
                        <li>Jika kategori sudah memiliki paket, pertimbangkan dampak perubahan nama</li>
                    </ul>
                </div>
            </div>
        </div>
    </x-alert>
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

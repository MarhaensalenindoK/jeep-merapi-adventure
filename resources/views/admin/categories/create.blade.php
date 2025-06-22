@extends('layouts.admin.app')

@section('title', 'Tambah Kategori')

@php
    $breadcrumbs = [
        ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['title' => 'Manajemen Kategori', 'url' => route('admin.categories.index')],
        ['title' => 'Tambah Kategori'],
    ];
@endphp

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="admin-card">
        <div class="mb-6">
            <h2 class="text-lg font-bold text-gray-900">Tambah Kategori Baru</h2>
            <p class="text-gray-600 mt-2 text-sm">Isi form dibawah untuk menambah kategori paket wisata</p>
        </div>

        <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-6">
            @csrf

            <!-- Nama Kategori -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <input type="text"
                    name="name"
                    id="name"
                    class="admin-input @error('name') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                    value="{{ old('name') }}"
                    placeholder="Contoh: Paket Keluarga"
                    required>
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-gray-500">Nama kategori harus jelas dan mudah dipahami</p>
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
                    placeholder="Deskripsi singkat tentang kategori ini...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-gray-500">Deskripsi opsional untuk menjelaskan kategori ini</p>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <x-button variant="outline" icon="arrow-left" :href="route('admin.categories.index')">
                    Kembali
                </x-button>

                <x-button type="submit" variant="primary" icon="check">
                    Simpan Kategori
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
                        <li>Gunakan nama yang singkat dan mudah dipahami</li>
                        <li>Pastikan kategori tidak duplikat dengan yang sudah ada</li>
                        <li>Deskripsi membantu pengunjung memahami jenis paket dalam kategori ini</li>
                    </ul>
                </div>
            </div>
        </div>
    </x-alert>
</div>
@endsection

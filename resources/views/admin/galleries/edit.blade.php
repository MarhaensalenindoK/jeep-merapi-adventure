@extends('layouts.admin.app')
@section('title', 'Edit Galeri')

@php
    $breadcrumbs = [
        ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['title' => 'Manajemen Galeri', 'url' => route('admin.galleries.index')],
        ['title' => 'Edit Galeri'],
    ];
@endphp

@section('content')
<main class="flex-1">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-bold text-gray-900">Edit Galeri</h2>
            <x-button variant="outline" icon="arrow-left" :href="route('admin.galleries.index')">
                Kembali
            </x-button>
        </div>

        <!-- Alert Messages -->
        @if($errors->any())
        <x-alert type="error" class="mb-4">
            <p class="font-medium">Terjadi kesalahan:</p>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-alert>
        @endif

        <!-- Info Alert -->
        <x-alert type="info" class="mb-6">
            <p class="font-medium">Tips Upload Gambar:</p>
            <ul class="mt-2 list-disc list-inside text-sm">
                <li>Format yang didukung: JPEG, PNG, JPG, WebP</li>
                <li>Ukuran maksimal: 15MB</li>
                <li>Resolusi yang disarankan: minimal 800x600 pixel</li>
                <li>Kosongkan jika tidak ingin mengganti gambar</li>
            </ul>
        </x-alert>

        <form method="POST" action="{{ route('admin.galleries.update', $gallery) }}" enctype="multipart/form-data" x-data="{}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column: Image Upload -->
                <div class="lg:col-span-1">
                    <div class="space-y-4">
                        <!-- Current Image -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Gambar Saat Ini
                            </label>
                            @if($gallery->image_path)
                                <div class="relative" x-data="{ showModal: false }">
                                    <img src="{{ asset('storage/' . $gallery->image_path) }}"
                                         alt="{{ $gallery->alt_text ?? $gallery->title }}"
                                         class="w-full h-64 object-cover rounded-lg shadow-sm cursor-pointer hover:opacity-90 transition-opacity"
                                         @click="showModal = true">
                                    <div class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-20 transition-all duration-200 rounded-lg flex items-center justify-center pointer-events-none">
                                        <div class="opacity-0 hover:opacity-100 bg-white text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition-opacity shadow-lg">
                                            <x-icon name="search" class="w-4 h-4 inline mr-2" />
                                            Klik untuk memperbesar
                                        </div>
                                    </div>

                                    <!-- Modal Full Image -->
                                    <div x-show="showModal"
                                         x-transition:enter="ease-out duration-300"
                                         x-transition:enter-start="opacity-0"
                                         x-transition:enter-end="opacity-100"
                                         x-transition:leave="ease-in duration-200"
                                         x-transition:leave-start="opacity-100"
                                         x-transition:leave-end="opacity-0"
                                         class="fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-75 flex items-center justify-center p-4"
                                         @click="showModal = false"
                                         @keydown.escape.window="showModal = false">
                                        <div class="relative max-w-7xl max-h-full">
                                            <img src="{{ asset('storage/' . $gallery->image_path) }}"
                                                 alt="{{ $gallery->alt_text ?? $gallery->title }}"
                                                 class="max-w-full max-h-full object-contain rounded-lg"
                                                 @click.stop>
                                            <button @click="showModal = false"
                                                    class="absolute top-4 right-4 bg-white bg-opacity-20 hover:bg-opacity-30 text-white rounded-full p-2 transition-colors">
                                                <x-icon name="close" class="w-6 h-6" />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <div class="text-center">
                                        <x-icon name="image" class="h-16 w-16 text-gray-400 mx-auto mb-2" />
                                        <p class="text-gray-500">Tidak ada gambar</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Image Upload -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Ganti Gambar (Opsional)
                            </label>
                            <!-- Main file input (always present but may be hidden) -->
                            <input id="image" name="image" type="file" accept="image/*" class="sr-only"
                                   @change="$store.gallery.previewImage($event)">

                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition-colors"
                                 @drop="$store.gallery.handleFileDrop($event)"
                                 @dragover.prevent
                                 @dragenter.prevent>
                                <div class="space-y-1 text-center">
                                    <div x-show="!$store.gallery.imagePreview">
                                        <x-icon name="image" class="mx-auto h-8 w-8 text-gray-400" />
                                        <div class="flex text-sm text-gray-600">
                                            <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-admin-primary hover:text-admin-secondary focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-admin-primary">
                                                <span>Upload gambar baru</span>
                                            </label>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, WebP hingga 15MB</p>
                                    </div>
                                    <div x-show="$store.gallery.imagePreview" class="relative">
                                        <img :src="$store.gallery.imagePreview" class="mx-auto max-h-48 rounded-lg" alt="Preview">
                                        <button @click="$store.gallery.clearPreview()" type="button"
                                                class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition-colors">
                                            <x-icon name="close" class="h-4 w-4" />
                                        </button>
                                        <div class="mt-2">
                                            <label for="image" class="cursor-pointer bg-white border border-gray-300 rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-admin-primary">
                                                Ganti Gambar
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Right Column: Form Fields -->
                <div class="lg:col-span-2">
                    <div class="space-y-6">
                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                Judul <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="title" name="title"
                                   class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-admin-primary focus:border-admin-primary"
                                   value="{{ old('title', $gallery->title) }}" required maxlength="255"
                                   placeholder="Masukkan judul galeri">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Deskripsi
                            </label>
                            <textarea id="description" name="description" rows="3"
                                      class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-admin-primary focus:border-admin-primary"
                                      placeholder="Masukkan deskripsi galeri (opsional)">{{ old('description', $gallery->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Alt Text -->
                        <div>
                            <label for="alt_text" class="block text-sm font-medium text-gray-700 mb-2">
                                Alt Text
                            </label>
                            <input type="text" id="alt_text" name="alt_text"
                                   class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-admin-primary focus:border-admin-primary"
                                   value="{{ old('alt_text', $gallery->alt_text) }}" maxlength="255"
                                   placeholder="Deskripsi gambar untuk aksesibilitas">
                            <p class="mt-1 text-sm text-gray-500">Alt text membantu aksesibilitas dan SEO</p>
                            @error('alt_text')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Package -->
                        <div>
                            <label for="package_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Paket Wisata
                            </label>
                            <x-select2 name="package_id"
                                       placeholder="Pilih paket (opsional)"
                                       :selected="old('package_id', $gallery->package_id)">
                                @foreach($packages as $package)
                                    <option value="{{ $package->id }}" {{ old('package_id', $gallery->package_id) == $package->id ? 'selected' : '' }}>
                                        {{ $package->name }}
                                    </option>
                                @endforeach
                            </x-select2>
                            <p class="mt-1 text-sm text-gray-500">Kosongkan jika gambar untuk umum</p>
                            @error('package_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Sort Order -->
                            <div>
                                <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">
                                    Urutan Tampil
                                </label>
                                <input type="number" id="sort_order" name="sort_order" min="0"
                                       class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-admin-primary focus:border-admin-primary"
                                       value="{{ old('sort_order', $gallery->sort_order) }}"
                                       placeholder="{{ $gallery->sort_order }}">
                                <p class="mt-1 text-sm text-gray-500">
                                    Angka kecil tampil lebih dulu. Urutan tertinggi saat ini: {{ $maxSortOrder }}
                                </p>
                                @error('sort_order')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Featured -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Status
                                </label>
                                <div class="flex items-center">
                                    <input type="checkbox" id="is_featured" name="is_featured" value="1"
                                           class="h-4 w-4 text-admin-primary focus:ring-admin-primary border-gray-300 rounded"
                                           {{ old('is_featured', $gallery->is_featured) ? 'checked' : '' }}>
                                    <label for="is_featured" class="ml-2 block text-sm text-gray-700">
                                        Jadikan gambar unggulan
                                    </label>
                                </div>
                                <p class="mt-1 text-sm text-gray-500">Gambar unggulan ditampilkan lebih menonjol</p>
                                @error('is_featured')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Audit Information -->
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Informasi</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                                <div>
                                    <span class="font-medium">Dibuat:</span>
                                    <div>{{ $gallery->created_at ? $gallery->created_at->format('d M Y, H:i') : '-' }}</div>
                                    @if($gallery->createdByUser)
                                        <div class="text-xs">oleh {{ $gallery->createdByUser->name }}</div>
                                    @endif
                                </div>
                                <div>
                                    <span class="font-medium">Diubah:</span>
                                    <div>{{ $gallery->updated_at ? $gallery->updated_at->format('d M Y, H:i') : '-' }}</div>
                                    @if($gallery->updatedByUser)
                                        <div class="text-xs">oleh {{ $gallery->updatedByUser->name }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col gap-3 sm:flex-row sm:justify-end sm:gap-4">
                <x-button variant="outline" icon="arrow-left" :href="route('admin.galleries.index')" type="button">
                    Batal
                </x-button>
                <x-button variant="primary" icon="check" type="submit">
                    Update Galeri
                </x-button>
            </div>
        </form>
    </div>
</main>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.store('gallery', {
        imagePreview: null,

        previewImage(event) {
            const file = event.target.files[0];
            if (file && file.type.startsWith('image/')) {
                // Check file size (15MB = 15 * 1024 * 1024 bytes)
                if (file.size > 15 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar. Maksimal 15MB.');
                    return;
                }

                const reader = new FileReader();
                reader.onload = (e) => {
                    this.imagePreview = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },

        clearPreview() {
            this.imagePreview = null;
            const imageInput = document.getElementById('image');
            if (imageInput) imageInput.value = '';
        },

        handleFileDrop(event) {
            event.preventDefault();
            const files = event.dataTransfer.files;
            if (files.length > 0) {
                const file = files[0];
                if (file.type.startsWith('image/')) {
                    // Set the file to the input
                    const imageInput = document.getElementById('image');
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    imageInput.files = dataTransfer.files;

                    // Preview the image
                    this.previewImage({target: {files: [file]}});
                } else {
                    alert('File harus berupa gambar (JPEG, PNG, JPG, WebP)');
                }
            }
        }
    });
});
</script>
@endsection

@extends('layouts.admin.app')
@section('title', 'Tambah Galeri')

@section('content')
<main class="flex-1">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-bold text-gray-900">Tambah Galeri</h2>
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
                <li>Gunakan gambar berkualitas tinggi untuk hasil terbaik</li>
                <li>File dapat di-drag dan drop langsung ke area upload</li>
            </ul>
        </x-alert>

        <form method="POST" action="{{ route('admin.galleries.store') }}" enctype="multipart/form-data" x-data="{}">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column: Image Upload -->
                <div class="lg:col-span-1">
                    <div class="space-y-4">
                        <!-- Image Upload -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Gambar <span class="text-red-500">*</span>
                            </label>
                            <!-- Main file input (always present but may be hidden) -->
                            <input id="image" name="image" type="file" accept="image/*" class="sr-only"
                                   @change="$store.gallery.previewImage($event)" required>

                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition-colors"
                                 @drop="$store.gallery.handleFileDrop($event)"
                                 @dragover.prevent
                                 @dragenter.prevent>
                                <div class="space-y-1 text-center">
                                    <div x-show="!$store.gallery.imagePreview">
                                        <x-icon name="image" class="mx-auto h-12 w-12 text-gray-400" />
                                        <div class="flex text-sm text-gray-600">
                                            <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-admin-primary hover:text-admin-secondary focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-admin-primary">
                                                <span>Upload gambar</span>
                                            </label>
                                            <p class="pl-1"> atau drag and drop</p>
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
                                   value="{{ old('title') }}" required maxlength="255"
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
                                      placeholder="Masukkan deskripsi galeri (opsional)">{{ old('description') }}</textarea>
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
                                   value="{{ old('alt_text') }}" maxlength="255"
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
                                       :selected="old('package_id')">
                                @foreach($packages as $package)
                                    <option value="{{ $package->id }}" {{ old('package_id') == $package->id ? 'selected' : '' }}>
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
                                       value="{{ old('sort_order', $nextSortOrder) }}"
                                       placeholder="{{ $nextSortOrder }}">
                                <p class="mt-1 text-sm text-gray-500">
                                    Angka kecil tampil lebih dulu. Urutan terakhir: {{ $nextSortOrder - 1 > 0 ? $nextSortOrder - 1 : 0 }}
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
                                           {{ old('is_featured') ? 'checked' : '' }}>
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
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col gap-3 sm:flex-row sm:justify-end sm:gap-4">
                <x-button variant="outline" icon="arrow-left" :href="route('admin.galleries.index')" type="button">
                    Batal
                </x-button>
                <x-button variant="primary" icon="check" type="submit">
                    Simpan Galeri
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

@extends('layouts.admin.app')
@section('title', 'Detail Galeri')

@php
    $breadcrumbs = [
        ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['title' => 'Manajemen Galeri', 'url' => route('admin.galleries.index')],
        ['title' => 'Detail Galeri'],
    ];
@endphp

@section('content')
<main class="flex-1" x-data="{ showDeleteModal: false }">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4 md:mb-0">Detail Galeri</h2>
            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                <x-button variant="outline" icon="arrow-left" :href="route('admin.galleries.index')" class="sm:w-auto">
                    Kembali
                </x-button>
                <x-button variant="secondary" icon="edit" :href="route('admin.galleries.edit', $gallery)" class="sm:w-auto">
                    Edit
                </x-button>
                <x-button variant="danger" icon="delete" @click="showDeleteModal = true" class="sm:w-auto">
                    Hapus
                </x-button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column: Image Display -->
            <div class="lg:col-span-2">
                <div class="space-y-4">
                    <!-- Main Image -->
                    <div class="relative group" x-data="{ showModal: false }">
                        @if($gallery->image_path)
                            <img src="{{ asset('storage/' . $gallery->image_path) }}"
                                 alt="{{ $gallery->alt_text ?? $gallery->title }}"
                                 class="w-full h-auto max-h-96 object-contain rounded-lg shadow-lg bg-gray-50 cursor-pointer hover:opacity-90 transition-opacity"
                                 @click="showModal = true">
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 rounded-lg flex items-center justify-center pointer-events-none">
                                <div class="opacity-0 group-hover:opacity-100 bg-white text-gray-700 px-4 py-2 rounded-lg font-medium transition-opacity shadow-lg">
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
                        @else
                            <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                                <div class="text-center">
                                    <x-icon name="image" class="h-16 w-16 text-gray-400 mx-auto mb-4" />
                                    <p class="text-gray-500">Gambar tidak tersedia</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Navigation -->
                    @if($prevGallery || $nextGallery)
                    <div class="flex justify-between items-center pt-4 border-t">
                        <div>
                            @if($prevGallery)
                                <x-button variant="outline" size="sm" icon="arrow-left" :href="route('admin.galleries.show', $prevGallery)">
                                    Sebelumnya
                                </x-button>
                            @endif
                        </div>
                        <div class="text-sm text-gray-500">
                            @if($gallery->package)
                                Galeri dalam paket: {{ $gallery->package->name }}
                            @endif
                        </div>
                        <div>
                            @if($nextGallery)
                                <x-button variant="outline" size="sm" icon="arrow-right" :href="route('admin.galleries.show', $nextGallery)">
                                    Selanjutnya
                                </x-button>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Right Column: Gallery Details -->
            <div class="lg:col-span-1">
                <div class="space-y-6">
                    <!-- Basic Info -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Galeri</h3>

                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Judul</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $gallery->title }}</p>
                            </div>

                            @if($gallery->description)
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $gallery->description }}</p>
                            </div>
                            @endif

                            @if($gallery->alt_text)
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Alt Text</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $gallery->alt_text }}</p>
                            </div>
                            @endif

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Paket Wisata</label>
                                @if($gallery->package)
                                    <div class="mt-1 flex items-center">
                                        <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">
                                            {{ $gallery->package->name }}
                                        </span>
                                        <a href="{{ route('admin.packages.show', $gallery->package) }}"
                                           class="ml-2 text-admin-primary hover:text-admin-secondary text-sm">
                                            Lihat Paket
                                        </a>
                                    </div>
                                @else
                                    <span class="mt-1 px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded">
                                        Galeri Umum
                                    </span>
                                @endif
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Urutan</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $gallery->sort_order }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Status</label>
                                    @if($gallery->is_featured)
                                        <span class="mt-1 inline-flex px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded">
                                            <x-icon name="star" class="w-3 h-3 mr-1" />
                                            Unggulan
                                        </span>
                                    @else
                                        <span class="mt-1 inline-flex px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded">
                                            Biasa
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Audit Information -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Audit</h3>

                        <div class="space-y-3 text-sm">
                            <div>
                                <label class="block font-medium text-gray-700">Dibuat</label>
                                <p class="mt-1 text-gray-600">{{ $gallery->created_at->format('d M Y, H:i') }}</p>
                                @if($gallery->createdByUser)
                                    <p class="text-xs text-gray-500">oleh {{ $gallery->createdByUser->name }}</p>
                                @endif
                            </div>

                            <div>
                                <label class="block font-medium text-gray-700">Terakhir Diubah</label>
                                <p class="mt-1 text-gray-600">{{ $gallery->updated_at->format('d M Y, H:i') }}</p>
                                @if($gallery->updatedByUser)
                                    <p class="text-xs text-gray-500">oleh {{ $gallery->updatedByUser->name }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="space-y-3">
                        <x-button variant="primary" icon="edit" :href="route('admin.galleries.edit', $gallery)" class="w-full">
                            Edit Galeri
                        </x-button>
                        <x-button variant="danger" icon="delete" @click="showDeleteModal = true" class="w-full">
                            Hapus Galeri
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <x-delete-modal show="showDeleteModal"
                    title="Hapus Galeri">
        <p>Apakah Anda yakin ingin menghapus galeri "<strong>{{ $gallery->title }}</strong>"?</p>
        <p class="text-sm text-gray-500 mt-2">Gambar dan semua data akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.</p>

        <x-slot name="actions">
            <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <x-button variant="danger" icon="delete" type="submit"
                          class="inline-flex w-full justify-center sm:ml-3 sm:w-auto">
                    Hapus Galeri
                </x-button>
            </form>

            <x-button variant="outline" @click="showDeleteModal = false"
                      class="mt-3 inline-flex w-full justify-center sm:mt-0 sm:w-auto">
                Batal
            </x-button>
        </x-slot>
    </x-delete-modal>
</main>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('URL berhasil disalin!');
    }).catch(function(err) {
        console.error('Gagal menyalin URL: ', err);
    });
}
</script>
@endsection

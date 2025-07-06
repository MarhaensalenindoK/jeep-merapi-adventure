@extends('layouts.admin.app')
@section('title', 'Detail Paket Wisata')

@php
    $breadcrumbs = [
        ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['title' => 'Manajemen Paket', 'url' => route('admin.packages.index')],
        ['title' => 'Detail Paket'],
    ];
@endphp

@section('content')
<main class="flex-1 p-6" x-data="{
    currentImageIndex: 0,
    showModal: false,
    images: [
        @if($package->galleries && $package->galleries->count() > 0)
            @foreach($package->galleries as $gallery)
                @if(file_exists(public_path('storage/' . $gallery->image_path)))
                {
                    src: '{{ asset('storage/' . $gallery->image_path) }}',
                    alt: '{{ $gallery->alt_text ?? $gallery->title }}',
                    title: '{{ $gallery->title }}',
                    package: '{{ $package->name }}'
                },
                @endif
            @endforeach
        @endif
    ],
    openModal(index) {
        this.currentImageIndex = index;
        this.showModal = true;
        document.body.style.overflow = 'hidden';
    },
    closeModal() {
        this.showModal = false;
        document.body.style.overflow = 'auto';
    },
    nextImage() {
        this.currentImageIndex = (this.currentImageIndex + 1) % this.images.length;
    },
    prevImage() {
        this.currentImageIndex = this.currentImageIndex === 0 ? this.images.length - 1 : this.currentImageIndex - 1;
    }
}" @keydown.escape.window="closeModal()" @keydown.arrow-left.window="showModal && prevImage()" @keydown.arrow-right.window="showModal && nextImage()">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4 md:mb-0">Detail Paket: {{ $package->name }}</h2>
            <div class="flex space-x-2">
                {{-- <a href="{{ route('admin.packages.edit', $package) }}" class="px-4 py-2 bg-yellow-500 rounded-lg hover:bg-yellow-600 text-sm inline-flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a> --}}
                <a href="{{ route('admin.packages.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 text-sm">
                    ← Kembali
                </a>
            </div>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="mb-6 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content - Left & Center -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Information -->
                <div class="bg-gradient-to-r from-admin-secondary to-admin-accent p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-2 text-gray-100">{{ $package->name }}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div>
                            <p class="text-gray-100 opacity-90">Kategori</p>
                            <p class="font-semibold text-gray-100">{{ $package->category->name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-100 opacity-90">Harga</p>
                            <p class="font-semibold text-lg text-gray-100">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-100 opacity-90">Durasi</p>
                            <p class="font-semibold text-gray-100">{{ $package->duration }}</p>
                        </div>
                    </div>
                </div>

                <!-- Rute Perjalanan -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h4 class="text-lg font-semibold text-gray-900 mb-3">Rute Perjalanan</h4>
                    <div class="ckeditor-content">
                        {!! $package->routes !!}
                    </div>
                </div>

                <!-- Deskripsi Lengkap -->
                @if($package->full_description)
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h4 class="text-lg font-semibold text-gray-900 mb-3">Deskripsi Lengkap</h4>
                    <div class="ckeditor-content">
                        {!! $package->full_description !!}
                    </div>
                </div>
                @endif

                <!-- Galleries -->
                @if($package->galleries && $package->galleries->count() > 0)
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h4 class="text-lg font-semibold text-gray-900 mb-3">Galeri Foto</h4>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @php $imageIndex = 0; @endphp
                        @foreach($package->galleries as $gallery)
                            @if(file_exists(public_path('storage/' . $gallery->image_path)))
                            <div class="relative group cursor-pointer" @click="openModal({{ $imageIndex }})">
                                <img src="{{ asset('storage/' . $gallery->image_path) }}"
                                     alt="{{ $gallery->alt_text }}"
                                     class="w-full h-32 object-cover rounded-lg transition-transform duration-300 group-hover:scale-105">
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-200 rounded-lg flex items-center justify-center">
                                    <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-center">
                                        <div class="text-white">
                                            <svg class="w-8 h-8 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.293l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd"/>
                                            </svg>
                                            <p class="text-sm font-medium">Lihat Foto</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php $imageIndex++; @endphp
                            @endif
                        @endforeach
                    </div>
                </div>
                @else
                <div class="bg-yellow-50 border border-yellow-200 p-6 rounded-lg">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-yellow-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-yellow-800">Belum ada foto galeri untuk paket ini.</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar - Right -->
            <div class="space-y-6">
                <!-- Quick Actions -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="font-semibold text-gray-900 mb-3">Aksi Cepat</h4>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('admin.packages.edit', $package) }}"
                           class="flex-1 sm:flex-none px-3 py-2 rounded-lg text-center text-sm inline-flex items-center justify-center">
                            <svg class="w-4 h-4 sm:mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            <span class="hidden sm:inline">Edit</span>
                        </a>
                        <button type="button"
                                x-data
                                @click="$dispatch('open-delete-modal', { package: {{ $package->toJson() }} })"
                                class="flex-1 sm:flex-none px-3 py-2 rounded-lg text-center text-sm inline-flex items-center justify-center text-red-500">
                            <svg class="w-4 h-4 sm:mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            <span class="hidden sm:inline">Hapus</span>
                        </button>
                    </div>
                </div>

                <!-- Package Stats -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="font-semibold text-gray-900 mb-3">Statistik</h4>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Kategori:</span>
                            <span class="font-medium">{{ $package->category->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Slug:</span>
                            <span class="font-mono text-xs bg-gray-200 px-2 py-1 rounded">{{ $package->slug }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Foto:</span>
                            <span class="font-medium">{{ $package->galleries->count() }} foto</span>
                        </div>
                    </div>
                </div>

                <!-- Metadata -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="font-semibold text-gray-900 mb-3">Informasi Sistem</h4>
                    <div class="space-y-3 text-sm text-gray-600">
                        <div>
                            <p class="font-medium">Dibuat:</p>
                            <p>{{ $package->created_at ? $package->created_at->format('d/m/Y H:i') : '-' }}</p>
                            @if($package->createdByUser)
                                <p class="text-xs">oleh {{ $package->createdByUser->name }}</p>
                            @endif
                        </div>

                        @if($package->updated_at != $package->created_at)
                        <div class="border-t pt-3">
                            <p class="font-medium">Terakhir diubah:</p>
                            <p>{{ $package->updated_at ? $package->updated_at->format('d/m/Y H:i') : '-' }}</p>
                            @if($package->updatedByUser)
                                <p class="text-xs">oleh {{ $package->updatedByUser->name }}</p>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Related Category -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="font-semibold text-gray-900 mb-3">Kategori Terkait</h4>
                    <div class="block p-3 bg-white rounded border hover:shadow-sm transition-shadow">
                        <h5 class="font-medium">{{ $package->category->name }}</h5>
                        @if($package->category->description)
                            @if(strlen($package->category->description) > 100)
                                <p class="text-sm text-gray-600 mt-1 cursor-help"
                                   title="{{ $package->category->description }}">
                                    {{ Str::limit($package->category->description, 100) }}
                                </p>
                            @else
                                <p class="text-sm text-gray-600 mt-1">{{ $package->category->description }}</p>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal (Universal) -->
    <div x-data="{ showDeleteModal: false, packageToDelete: null }"
         @open-delete-modal.window="showDeleteModal = true; packageToDelete = $event.detail.package">

        <!-- Modal Backdrop -->
        <div x-show="showDeleteModal"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center p-4"
             @click.self="showDeleteModal = false"
             style="display: none;">

            <!-- Modal Content -->
            <div x-show="showDeleteModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="bg-white rounded-lg shadow-xl max-w-md w-full">

                <div class="px-6 py-4">
                    <div class="flex items-center mb-4">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                        </div>
                    </div>

                    <div class="text-center">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Konfirmasi Hapus Paket</h3>
                        <p class="text-sm text-gray-500 mb-4">
                            Apakah Anda yakin ingin menghapus paket
                            <span class="font-semibold" x-text="packageToDelete?.name"></span>?
                            <br><br>
                            Tindakan ini tidak dapat dibatalkan.
                        </p>
                    </div>
                </div>

                <div class="bg-gray-50 px-6 py-3 flex flex-col sm:flex-row-reverse gap-3">
                    <form method="POST" action="{{ route('admin.packages.destroy', $package) }}" class="w-full sm:w-auto">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full sm:w-auto px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                            Ya, Hapus
                        </button>
                    </form>

                    <button type="button"
                            @click="showDeleteModal = false"
                            class="w-full sm:w-auto px-4 py-2 bg-white text-gray-700 text-sm font-medium rounded-md border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-admin-primary">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Gallery -->
    <div x-show="showModal" class="fixed inset-0 z-50" aria-labelledby="gallery-modal" role="dialog" aria-modal="true">
        <!-- Background backdrop -->
        <div x-show="showModal"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-gray-900/90 transition-opacity"
             aria-hidden="true"
             @click="closeModal()"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center">
                <!-- Dialog panel -->
                <div x-show="showModal"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="relative transform overflow-hidden rounded-lg bg-black text-left shadow-xl transition-all sm:my-8 w-full max-w-7xl"
                     @click.stop>

                    <!-- Gallery Content -->
                    <div class="bg-black px-4 pt-5 pb-4 sm:p-6 relative">
                        <!-- Close Button -->
                        <button @click="closeModal()"
                                class="absolute top-4 right-4 bg-white bg-opacity-20 hover:bg-opacity-30 text-white rounded-full p-2 transition-colors z-20">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>

                        <!-- Image Container -->
                        <div class="flex items-center justify-center relative min-h-[70vh]">
                            <!-- Previous Button -->
                            <button @click="prevImage()"
                                    x-show="images.length > 1"
                                    class="absolute left-4 top-1/2 -translate-y-1/2 bg-white bg-opacity-20 hover:bg-opacity-30 text-white rounded-full p-3 transition-all z-10">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </button>

                            <!-- Image -->
                            <img :src="images[currentImageIndex]?.src"
                                 :alt="images[currentImageIndex]?.alt"
                                 class="max-w-full max-h-[80vh] object-contain rounded-lg">

                            <!-- Next Button -->
                            <button @click="nextImage()"
                                    x-show="images.length > 1"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 bg-white bg-opacity-20 hover:bg-opacity-30 text-white rounded-full p-3 transition-all z-10">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>

                        <!-- Image Info -->
                        <div class="mt-6 text-center">
                            <h3 class="text-xl font-medium text-white" x-text="images[currentImageIndex]?.title"></h3>
                            <p class="text-sm text-gray-300 mt-1" x-text="images[currentImageIndex]?.package"></p>
                            <p class="text-sm text-gray-400 mt-2" x-show="images.length > 1">
                                <span x-text="currentImageIndex + 1"></span> dari <span x-text="images.length"></span> foto
                            </p>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="bg-gray-800 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button"
                                @click="closeModal()"
                                class="inline-flex w-full justify-center rounded-md bg-admin-primary px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-admin-secondary sm:ml-3 sm:w-auto">
                            Tutup
                        </button>
                        <a href="{{ route('admin.galleries.index') }}"
                           class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-gray-300 ring-inset hover:bg-gray-50 sm:mt-0 sm:w-auto">
                            Kelola Galeri
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

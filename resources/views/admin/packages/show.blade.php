@extends('layouts.admin.app')
@section('title', 'Detail Paket Wisata')
@section('content')
<main class="flex-1 p-6">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4 md:mb-0">Detail Paket: {{ $package->name }}</h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.packages.edit', $package) }}" class="px-4 py-2 bg-yellow-500 rounded-lg hover:bg-yellow-600 text-sm inline-flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
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
                    <h3 class="text-xl font-bold mb-2">{{ $package->name }}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div>
                            <p class="text-gray-100 opacity-90">Kategori</p>
                            <p class="font-semibold">{{ $package->category->name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-100 opacity-90">Harga</p>
                            <p class="font-semibold text-lg">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-100 opacity-90">Durasi</p>
                            <p class="font-semibold">{{ $package->duration }}</p>
                        </div>
                    </div>
                </div>

                <!-- Rute Perjalanan -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h4 class="text-lg font-semibold text-gray-900 mb-3">Rute Perjalanan</h4>
                    <div class="prose max-w-none">
                        <p class="text-gray-700 whitespace-pre-line">{{ $package->routes }}</p>
                    </div>
                </div>

                <!-- Deskripsi Lengkap -->
                @if($package->full_description)
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h4 class="text-lg font-semibold text-gray-900 mb-3">Deskripsi Lengkap</h4>
                    <div class="prose max-w-none">
                        <p class="text-gray-700 whitespace-pre-line">{{ $package->full_description }}</p>
                    </div>
                </div>
                @endif

                <!-- Galleries -->
                @if($package->galleries && $package->galleries->count() > 0)
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h4 class="text-lg font-semibold text-gray-900 mb-3">Galeri Foto</h4>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($package->galleries as $gallery)
                            <div class="relative group">
                                <img src="{{ asset('storage/' . $gallery->image_path) }}"
                                     alt="{{ $gallery->alt_text }}"
                                     class="w-full h-32 object-cover rounded-lg">
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-200 rounded-lg flex items-center justify-center">
                                    <button class="opacity-0 group-hover:opacity-100 text-white text-sm bg-black bg-opacity-50 px-3 py-1 rounded">
                                        Lihat
                                    </button>
                                </div>
                            </div>
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
                            <p>{{ $package->created_at->format('d/m/Y H:i') }}</p>
                            @if($package->createdByUser)
                                <p class="text-xs">oleh {{ $package->createdByUser->name }}</p>
                            @endif
                        </div>

                        @if($package->updated_at != $package->created_at)
                        <div class="border-t pt-3">
                            <p class="font-medium">Terakhir diubah:</p>
                            <p>{{ $package->updated_at->format('d/m/Y H:i') }}</p>
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
</main>
@endsection

@extends('layouts.admin.app')
@section('title', 'Detail Artikel')

@php
    $breadcrumbs = [
        ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['title' => 'Manajemen Blog', 'url' => route('admin.posts.index')],
        ['title' => 'Detail Artikel'],
    ];
@endphp

@section('content')
<main class="flex-1">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-bold text-gray-900">Detail Artikel</h2>
            <div class="flex space-x-3">
                <x-button variant="outline" icon="arrow-left" :href="route('admin.posts.index')">
                    Kembali
                </x-button>
                <x-button variant="primary" icon="edit" :href="route('admin.posts.edit', $post)">
                    Edit
                </x-button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column: Featured Image -->
            <div class="lg:col-span-1">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Gambar Utama
                        </label>
                        @if($post->featured_image)
                            <div class="relative cursor-pointer" onclick="openImageModal('{{ asset('storage/' . $post->featured_image) }}', '{{ $post->title }}')">
                                <img src="{{ asset('storage/' . $post->featured_image) }}"
                                     alt="{{ $post->title }}"
                                     class="w-full h-64 object-cover rounded-lg shadow-sm hover:shadow-lg transition-shadow">
                                <div class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-20 transition-all duration-200 rounded-lg flex items-center justify-center">
                                    <div class="opacity-0 hover:opacity-100 bg-white text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition-opacity shadow-lg">
                                        <x-icon name="eye" class="w-4 h-4 inline mr-2" />
                                        Klik untuk melihat
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                                <div class="text-center">
                                    <x-icon name="image" class="h-16 w-16 text-gray-400 mx-auto mb-2" />
                                    <p class="text-gray-500">Tidak ada gambar utama</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Quick Stats -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-sm font-medium text-gray-700 mb-3">Statistik Artikel</h4>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Jumlah Kata:</span>
                                <span class="font-medium">{{ str_word_count(strip_tags($post->body)) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Karakter:</span>
                                <span class="font-medium">{{ strlen(strip_tags($post->body)) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Estimasi Baca:</span>
                                <span class="font-medium">{{ ceil(str_word_count(strip_tags($post->body)) / 200) }} menit</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Content -->
            <div class="lg:col-span-2">
                <div class="space-y-6">
                    <!-- Title & Metadata -->
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $post->title }}</h1>
                        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
                            <div class="flex items-center">
                                <x-icon name="user" class="w-4 h-4 mr-1" />
                                {{ $post->author->name }}
                            </div>
                            <div class="flex items-center">
                                <x-icon name="calendar" class="w-4 h-4 mr-1" />
                                {{ $post->created_at ? $post->created_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') : '-' }}
                            </div>
                            @if($post->is_published)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <x-icon name="check" class="w-3 h-3 mr-1" />
                                    Dipublikasi {{ $post->updated_at ? $post->updated_at->setTimezone('Asia/Jakarta')->format('d M Y') : '-' }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    <x-icon name="edit" class="w-3 h-3 mr-1" />
                                    Draft
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Slug -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">URL Slug</label>
                        <div class="flex items-center bg-gray-50 rounded-lg px-3 py-2">
                            <x-icon name="link" class="w-4 h-4 text-gray-400 mr-2" />
                            <code class="text-sm text-gray-800 bg-transparent">{{ $post->slug }}</code>
                            <button onclick="navigator.clipboard.writeText('{{ $post->slug }}')"
                                    class="ml-auto text-gray-400 hover:text-gray-600"
                                    title="Copy slug">
                                <x-icon name="copy" class="w-4 h-4" />
                            </button>
                        </div>
                    </div>

                    <!-- Content -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Konten Artikel</label>
                        <div class="bg-gray-50 rounded-lg p-4 ckeditor-content">
                            {!! $post->body !!}
                        </div>
                    </div>

                    <!-- Audit Information -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Informasi Audit</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                            <div>
                                <span class="font-medium">Dibuat:</span>
                                <div>{{ $post->created_at ? $post->created_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') : '-' }}</div>
                                @if($post->created_by && $post->createdByUser)
                                    <div class="text-xs">oleh {{ $post->createdByUser->name }}</div>
                                @endif
                            </div>
                            <div>
                                <span class="font-medium">Diubah:</span>
                                <div>{{ $post->updated_at ? $post->updated_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') : '-' }}</div>
                                @if($post->updated_by && $post->updatedByUser)
                                    <div class="text-xs">oleh {{ $post->updatedByUser->name }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-6 pt-6 border-t border-gray-200">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-3 sm:space-y-0">
                <div class="flex space-x-3">
                    <x-button variant="outline" icon="arrow-left" :href="route('admin.posts.index')">
                        Kembali ke Daftar
                    </x-button>
                    <x-button variant="primary" icon="edit" :href="route('admin.posts.edit', $post)">
                        Edit Artikel
                    </x-button>
                </div>

                <div x-data="{ showDeleteModal: false }">
                    <x-button variant="danger"
                              icon="delete"
                              @click="showDeleteModal = true"
                              type="button">
                        Hapus Artikel
                    </x-button>

                    <!-- Delete Modal -->
                    <div x-show="showDeleteModal"
                         x-transition
                         class="fixed inset-0 z-50 overflow-y-auto"
                         style="display: none;">
                        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <div x-show="showDeleteModal"
                                 x-transition:enter="ease-out duration-300"
                                 x-transition:enter-start="opacity-0"
                                 x-transition:enter-end="opacity-100"
                                 x-transition:leave="ease-in duration-200"
                                 x-transition:leave-start="opacity-100"
                                 x-transition:leave-end="opacity-0"
                                 class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"
                                 @click="showDeleteModal = false"></div>

                            <div x-show="showDeleteModal"
                                 x-transition:enter="ease-out duration-300"
                                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                 x-transition:leave="ease-in duration-200"
                                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                 class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">

                                <div class="sm:flex sm:items-start">
                                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                        <x-icon name="delete" class="h-6 w-6 text-red-600" />
                                    </div>
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900">Hapus Artikel</h3>
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-500">
                                                Apakah Anda yakin ingin menghapus artikel "<strong>{{ $post->title }}</strong>"?
                                                Artikel dan semua data akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <x-button variant="danger"
                                                  icon="delete"
                                                  type="submit"
                                                  class="w-full justify-center sm:ml-3 sm:w-auto">
                                            Hapus Artikel
                                        </x-button>
                                    </form>
                                    <x-button variant="outline"
                                              @click="showDeleteModal = false"
                                              class="mt-3 w-full justify-center sm:mt-0 sm:w-auto">
                                        Batal
                                    </x-button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Image Preview Modal -->
<div id="imageModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Backdrop -->
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" onclick="closeImageModal()"></div>

        <!-- Modal Content -->
        <div class="inline-block align-middle bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <!-- Header -->
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modalImageTitle">
                        Preview Gambar
                    </h3>
                    <button type="button" onclick="closeImageModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <x-icon name="close" class="h-6 w-6" />
                    </button>
                </div>

                <!-- Image Container -->
                <div class="text-center">
                    <img id="modalImage" src="" alt="" class="max-w-full max-h-96 mx-auto rounded-lg shadow-lg">
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <a id="modalImageLink" href="" target="_blank" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                    <x-icon name="external-link" class="w-4 h-4 mr-2" />
                    Lihat di Layar Penuh
                </a>
                <button type="button" onclick="closeImageModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function openImageModal(imageSrc, imageTitle) {
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const modalImageTitle = document.getElementById('modalImageTitle');
    const modalImageLink = document.getElementById('modalImageLink');

    modalImage.src = imageSrc;
    modalImage.alt = imageTitle;
    modalImageTitle.textContent = imageTitle || 'Preview Gambar';
    modalImageLink.href = imageSrc;

    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    const modal = document.getElementById('imageModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal();
    }
});
</script>
@endpush
@endsection

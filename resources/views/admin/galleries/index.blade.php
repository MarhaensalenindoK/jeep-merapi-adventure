@extends('layouts.admin.app')
@section('title', 'Manajemen Galeri')

@push('styles')
<style>
/* Tooltip styling */
[data-tooltip] {
    position: relative;
    cursor: help;
}

[data-tooltip]:hover:after {
    content: attr(data-tooltip);
    position: absolute;
    bottom: 125%;
    left: 50%;
    transform: translateX(-50%);
    background-color: #1f2937;
    color: white;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: normal;
    white-space: nowrap;
    z-index: 1000;
    opacity: 0;
    animation: tooltipFadeIn 0.2s forwards;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

[data-tooltip]:hover:before {
    content: '';
    position: absolute;
    bottom: 115%;
    left: 50%;
    transform: translateX(-50%);
    border: 5px solid transparent;
    border-top-color: #1f2937;
    z-index: 1000;
    opacity: 0;
    animation: tooltipFadeIn 0.2s forwards;
}

@keyframes tooltipFadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}
</style>
@endpush

@section('content')
<main class="flex-1 p-6" x-data="{ showDeleteModal: false, galleryToDelete: null }">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4 md:mb-0">Daftar Galeri</h2>
            <x-button variant="primary" icon="plus" :href="route('admin.galleries.create')">
                Tambah Galeri
            </x-button>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
        <x-alert type="success" class="mb-4">
            <p>{{ session('success') }}</p>
        </x-alert>
        @endif

        @if(session('error'))
        <x-alert type="error" class="mb-4">
            <p>{{ session('error') }}</p>
        </x-alert>
        @endif

        <!-- Filter & Search Form -->
        <form method="GET" action="{{ route('admin.galleries.index') }}">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                <!-- Search Input -->
                <div class="relative md:col-span-2">
                    <input type="text" name="search" placeholder="Cari galeri, deskripsi, atau paket..."
                           class="w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg focus:ring-admin-primary focus:border-admin-primary"
                           value="{{ request('search') }}"
                           id="search-input">
                    @if(request('search'))
                    <div class="absolute inset-y-0 right-8 flex items-center pr-2">
                        <x-button variant="ghost"
                                  size="icon-sm"
                                  icon="close"
                                  onclick="document.getElementById('search-input').value=''; this.closest('form').submit();"
                                  title="Clear search" />
                    </div>
                    @endif
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <x-icon name="search" class="h-5 w-5 text-gray-400" />
                    </div>
                </div>

                <!-- Package Filter -->
                <div>
                    <x-select2 name="package_id"
                               placeholder="Semua Paket"
                               :selected="request('package_id')">
                        @foreach($packages as $package)
                            <option value="{{ $package->id }}"
                                    {{ request('package_id') == $package->id ? 'selected' : '' }}>
                                {{ $package->name }}
                            </option>
                        @endforeach
                    </x-select2>
                </div>

                <!-- Action Buttons -->
                <div class="flex space-x-2">
                    <x-button variant="secondary" icon="search" type="submit" class="flex-1">
                        Cari
                    </x-button>
                    <x-button variant="outline" icon="refresh" :href="route('admin.galleries.index')" class="flex-1">
                        Reset
                    </x-button>
                </div>
            </div>
        </form>

        <!-- START: Tampilan Tabel untuk Desktop -->
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-50">
                    <tr>
                        @php
                            // Helper function untuk sorting link
                            $sortLink = function($field, $label) {
                                $direction = (request('sort') == $field && request('direction') == 'asc') ? 'desc' : 'asc';
                                $url = route('admin.galleries.index', array_merge(request()->query(), ['sort' => $field, 'direction' => $direction]));
                                $icon = request('sort') == $field ? (request('direction') == 'asc' ? '&#9650;' : '&#9660;') : '';
                                return '<a href="'.$url.'" class="flex items-center space-x-1"><span>'.$label.'</span> <span class="text-xs">'.$icon.'</span></a>';
                            };
                        @endphp
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{!! $sortLink('title', 'Judul') !!}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paket</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{!! $sortLink('created_at', 'Tanggal') !!}</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($galleries as $gallery)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex-shrink-0 h-12 w-12">
                                @if($gallery->image_path)
                                    <img class="h-12 w-12 rounded-lg object-cover"
                                         src="{{ asset('storage/' . $gallery->image_path) }}"
                                         alt="{{ $gallery->alt_text ?? $gallery->title }}">
                                @else
                                    <div class="h-12 w-12 rounded-lg bg-gray-200 flex items-center justify-center">
                                        <x-icon name="image" class="h-6 w-6 text-gray-400" />
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="font-semibold text-sm text-gray-900">{{ $gallery->title }}</div>
                            @if($gallery->is_featured)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                    <x-icon name="star" class="w-3 h-3 mr-1" />
                                    Unggulan
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($gallery->package)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800"
                                      title="{{ $gallery->package->name }}"
                                      data-tooltip="{{ $gallery->package->name }}">
                                    {{ Str::limit($gallery->package->name, 20) }}
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    Umum
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $gallery->created_at ? $gallery->created_at->format('d M Y') : '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="action-buttons-group desktop">
                                <!-- View Button -->
                                <a href="{{ route('admin.galleries.show', $gallery) }}"
                                   class="action-btn-icon action-btn-view"
                                   title="Detail">
                                    <x-icon name="eye" class="w-4 h-4" />
                                </a>

                                <!-- Edit Button -->
                                <a href="{{ route('admin.galleries.edit', $gallery) }}"
                                   class="action-btn-icon action-btn-edit"
                                   title="Edit">
                                    <x-icon name="edit" class="w-4 h-4" />
                                </a>

                                <!-- Delete Button -->
                                <button type="button"
                                        @click="galleryToDelete = { id: {{ $gallery->id }}, title: '{{ $gallery->title }}', route: '{{ route('admin.galleries.destroy', $gallery) }}' }; showDeleteModal = true"
                                        class="action-btn-icon action-btn-delete"
                                        title="Hapus">
                                    <x-icon name="delete" class="w-4 h-4" />
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-8 text-gray-500">Data tidak ditemukan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- END: Tampilan Tabel untuk Desktop -->

        <!-- START: Tampilan Kartu untuk Mobile -->
        <div class="block md:hidden space-y-4">
            @forelse($galleries as $gallery)
                <div class="bg-white p-4 rounded-lg shadow-md border border-gray-200">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            @if($gallery->image_path)
                                <img class="h-16 w-16 rounded-lg object-cover"
                                     src="{{ asset('storage/' . $gallery->image_path) }}"
                                     alt="{{ $gallery->alt_text ?? $gallery->title }}">
                            @else
                                <div class="h-16 w-16 rounded-lg bg-gray-200 flex items-center justify-center">
                                    <x-icon name="image" class="h-8 w-8 text-gray-400" />
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start">
                                <div class="font-bold text-base text-admin-primary">{{ $gallery->title }}</div>
                                @if($gallery->is_featured)
                                    <span class="ml-2 px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded flex items-center">
                                        <x-icon name="star" class="w-3 h-3 mr-1" />
                                        Unggulan
                                    </span>
                                @endif
                            </div>
                            @if($gallery->description)
                                <p class="text-sm text-gray-500 mt-1">{{ Str::limit($gallery->description, 60) }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="mt-4 grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <div class="text-gray-500">Paket</div>
                            <div class="font-medium text-gray-800">
                                @if($gallery->package)
                                    {{ $gallery->package->name }}
                                @else
                                    Umum
                                @endif
                            </div>
                        </div>
                        <div>
                            <div class="text-gray-500">Tanggal</div>
                            <div class="font-medium text-gray-800">{{ $gallery->created_at ? $gallery->created_at->format('d M Y') : '-' }}</div>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100 flex justify-end">
                        <div class="action-buttons-group mobile">
                            <!-- View Button -->
                            <a href="{{ route('admin.galleries.show', $gallery) }}"
                               class="action-btn-text action-btn-view">
                                <x-icon name="eye" class="w-4 h-4 mr-1" />
                                Detail
                            </a>

                            <!-- Edit Button -->
                            <a href="{{ route('admin.galleries.edit', $gallery) }}"
                               class="action-btn-text action-btn-edit">
                                <x-icon name="edit" class="w-4 h-4 mr-1" />
                                Edit
                            </a>

                            <!-- Delete Button -->
                            <button type="button"
                                    @click="galleryToDelete = { id: {{ $gallery->id }}, title: '{{ $gallery->title }}', route: '{{ route('admin.galleries.destroy', $gallery) }}' }; showDeleteModal = true"
                                    class="action-btn-text action-btn-delete">
                                <x-icon name="delete" class="w-4 h-4 mr-1" />
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-gray-500">
                    Data tidak ditemukan.
                </div>
            @endforelse
        </div>
        <!-- END: Tampilan Kartu untuk Mobile -->

        <!-- Pagination Links -->
        <div class="mt-6">
            {{ $galleries->withQueryString()->links() }}
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <x-delete-modal show="showDeleteModal"
                    item="galleryToDelete"
                    title="Hapus Galeri">
        <p>Apakah Anda yakin ingin menghapus galeri "<strong x-text="galleryToDelete?.title || ''"></strong>"?
        Gambar dan semua data akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.</p>
    </x-delete-modal>
</main>
@endsection

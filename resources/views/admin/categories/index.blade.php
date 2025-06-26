@extends('layouts.admin.app')
@section('title', 'Manajemen Kategori')
@section('content')
<main class="flex-1 p-6" x-data="{ showDeleteModal: false, categoryToDelete: null }">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4 md:mb-0">Daftar Kategori Paket</h2>
            <x-button variant="primary" icon="plus" :href="route('admin.categories.create')">
                Tambah Kategori
            </x-button>
        </div>

        <!-- Filter & Search Form -->
        <form method="GET" action="{{ route('admin.categories.index') }}">
            <div class="flex items-center space-x-4 mb-4">
                <div class="relative flex-grow">
                    <input type="text" name="search" placeholder="Cari kategori..."
                           class="w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg focus:ring-admin-primary focus:border-admin-primary"
                           value="{{ request('search') }}"
                           id="search-input">
                    @if(request('search'))
                        <button type="button"
                                onclick="document.getElementById('search-input').value=''; this.closest('form').submit();"
                                class="absolute inset-y-0 right-8 flex items-center pr-2 text-gray-400 hover:text-gray-600"
                                title="Clear search">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    @endif
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <x-button type="submit" variant="secondary" icon="search" icon-only="true" size="md" class="sm:px-6 sm:py-2">
                        <span class="hidden sm:inline">Cari</span>
                    </x-button>

                    @if(request('search'))
                        <x-button variant="gray" icon="close" :href="route('admin.categories.index')" title="Reset pencarian" icon-only="true" size="md" class="sm:px-4 sm:py-2">
                            <span class="hidden sm:inline">Reset</span>
                        </x-button>
                    @endif
                </div>
            </div>
            @if(request('search'))
                <x-alert type="info" class="mb-4">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-left">Menampilkan hasil pencarian untuk: <strong>"{{ request('search') }}"</strong></span>
                        <a href="{{ route('admin.categories.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium whitespace-nowrap">
                            Tampilkan semua
                        </a>
                    </div>
                </x-alert>
            @endif
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
                                $url = route('admin.categories.index', array_merge(request()->query(), ['sort' => $field, 'direction' => $direction]));
                                $icon = request('sort') == $field ? (request('direction') == 'asc' ? '&#9650;' : '&#9660;') : '';
                                return '<a href="'.$url.'" class="flex items-center space-x-1"><span>'.$label.'</span> <span class="text-xs">'.$icon.'</span></a>';
                            };
                        @endphp
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{!! $sortLink('name', 'Nama Kategori') !!}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{!! $sortLink('packages_count', 'Jumlah Paket') !!}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dibuat Oleh</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{!! $sortLink('created_at', 'Tanggal Dibuat') !!}</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($categories as $category)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap"><div class="font-semibold text-sm text-gray-900">{{ $category->name }}</div></td>
                        <td class="px-6 py-4 whitespace-nowrap"><span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ $category->packages_count }} paket</span></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $category->createdByUser->name ?? 'Sistem' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $category->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="action-buttons-group desktop">
                                <!-- Edit Button -->
                                <a href="{{ route('admin.categories.edit', $category) }}"
                                   class="action-btn-icon action-btn-edit"
                                   title="Edit">
                                    <x-icon name="edit" class="w-4 h-4" />
                                </a>

                                <!-- Delete Button -->
                                <button type="button"
                                        @click="categoryToDelete = { id: {{ $category->id }}, name: '{{ $category->name }}', route: '{{ route('admin.categories.destroy', $category) }}' }; showDeleteModal = true"
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
            @forelse($categories as $category)
                <div class="bg-white p-4 rounded-lg shadow-md border border-gray-200">
                    <div class="flex justify-between items-start">
                        <div class="font-bold text-base text-admin-primary">{{ $category->name }}</div>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ $category->packages_count }} paket</span>
                    </div>
                    <div class="mt-4 grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <div class="text-gray-500">Dibuat Oleh</div>
                            <div class="font-medium text-gray-800">{{ $category->createdByUser->name ?? 'Sistem' }}</div>
                        </div>
                        <div>
                            <div class="text-gray-500">Tanggal</div>
                            <div class="font-medium text-gray-800">{{ $category->created_at->format('d M Y') }}</div>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100 flex justify-end">
                        <div class="action-buttons-group mobile">
                            <!-- Edit Button -->
                            <a href="{{ route('admin.categories.edit', $category) }}"
                               class="action-btn-text action-btn-edit">
                                <x-icon name="edit" class="w-4 h-4 mr-1" />
                                Edit
                            </a>

                            <!-- Delete Button -->
                            <button type="button"
                                    @click="categoryToDelete = { id: {{ $category->id }}, name: '{{ $category->name }}', route: '{{ route('admin.categories.destroy', $category) }}' }; showDeleteModal = true"
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
            {{ $categories->withQueryString()->links() }}
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <x-delete-modal show="showDeleteModal"
                    item="categoryToDelete"
                    title="Hapus Kategori">
        <p>Apakah Anda yakin ingin menghapus kategori "<strong x-text="categoryToDelete?.name || ''"></strong>"?
        Semua data akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.</p>
    </x-delete-modal>
</main>
@endsection

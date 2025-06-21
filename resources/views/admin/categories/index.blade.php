@extends('layouts.admin.app')
@section('title', 'Manajemen Kategori')
@section('content')
<main class="flex-1 p-6" x-data="{ showDeleteModal: false, categoryToDelete: null }">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4 md:mb-0">Daftar Kategori Paket</h2>
            <a href="{{ route('admin.categories.create') }}" class="px-4 py-2 bg-admin-primary text-white rounded-lg hover:bg-admin-secondary text-sm">+ Tambah Kategori</a>
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
                    <button type="submit" class="px-6 py-2 bg-admin-secondary text-white rounded-lg hover:bg-admin-primary transition-colors duration-200">
                        <span class="hidden sm:inline">Cari</span>
                        <svg class="w-4 h-4 sm:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.categories.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200"
                           title="Reset pencarian">
                            <span class="hidden sm:inline">Reset</span>
                            <svg class="w-4 h-4 sm:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
            @if(request('search'))
                <div class="mb-4 px-4 py-2 bg-blue-50 border border-blue-200 rounded-lg">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm text-blue-700">
                                Menampilkan hasil pencarian untuk: <strong>"{{ request('search') }}"</strong>
                            </span>
                        </div>
                        <a href="{{ route('admin.categories.index') }}"
                           class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            Tampilkan semua
                        </a>
                    </div>
                </div>
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
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.categories.edit', $category) }}"
                                   class="inline-flex items-center p-2 border border-transparent rounded-full shadow-sm text-white bg-admin-primary hover:bg-admin-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-admin-primary">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                            @click="categoryToDelete = { id: {{ $category->id }}, name: '{{ $category->name }}', route: '{{ route('admin.categories.destroy', $category) }}' }; showDeleteModal = true"
                                            class="inline-flex items-center p-2 border border-transparent rounded-full shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
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
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-admin-primary hover:bg-admin-secondary">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                        @click="categoryToDelete = { id: {{ $category->id }}, name: '{{ $category->name }}', route: '{{ route('admin.categories.destroy', $category) }}' }; showDeleteModal = true"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Hapus
                                </button>
                            </form>
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

    <!-- Universal Delete Modal -->
    <div x-show="showDeleteModal"
         x-cloak
         class="relative z-10"
         aria-labelledby="modal-title"
         role="dialog"
         aria-modal="true"
         style="display: none;">
        <!-- Background backdrop -->
        <div x-show="showDeleteModal"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="showDeleteModal = false"
             class="fixed inset-0 bg-gray-500/75 transition-opacity"
             aria-hidden="true"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <!-- Dialog panel -->
                <div x-show="showDeleteModal"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">

                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                                <svg class="size-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-base font-semibold text-gray-900" id="modal-title">Hapus Kategori</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Apakah Anda yakin ingin menghapus kategori "<span x-text="categoryToDelete?.name || ''"></span>"? Semua data akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <form method="POST" :action="categoryToDelete?.route" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Hapus</button>
                        </form>
                        <button @click="showDeleteModal = false; categoryToDelete = null" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-gray-300 ring-inset hover:bg-gray-50 sm:mt-0 sm:w-auto">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

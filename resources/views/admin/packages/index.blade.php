@extends('layouts.admin.app')
@section('title', 'Manajemen Paket Wisata')

@push('styles')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
/* Select2 Main Container */
.select2-container--default .select2-selection--single {
    height: 42px !important;
    border: 1px solid #d1d5db !important;
    border-radius: 0.5rem !important;
    display: flex !important;
    align-items: center !important;
    background-color: #ffffff !important;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out !important;
}

/* Selected Text */
.select2-container--default .select2-selection--single .select2-selection__rendered {
    padding-left: 16px !important;
    padding-right: 45px !important;
    color: #374151 !important;
    line-height: 40px !important;
    font-size: 14px !important;
}

/* Arrow */
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 40px !important;
    right: 12px !important;
    top: 1px !important;
}

/* Focus State */
.select2-container--default.select2-container--focus .select2-selection--single,
.select2-container--default .select2-selection--single:focus {
    border-color: #1e40af !important;
    box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1) !important;
    outline: none !important;
}

/* Dropdown Container */
.select2-dropdown {
    border: 1px solid #d1d5db !important;
    border-radius: 0.5rem !important;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
    background-color: #ffffff !important;
    z-index: 9999 !important;
}

/* Search Field */
.select2-search--dropdown {
    padding: 8px !important;
}

.select2-search--dropdown .select2-search__field {
    border: 1px solid #d1d5db !important;
    border-radius: 0.375rem !important;
    padding: 8px 12px !important;
    font-size: 14px !important;
    color: #374151 !important;
    background-color: #ffffff !important;
    width: 100% !important;
    box-sizing: border-box !important;
}

.select2-search--dropdown .select2-search__field:focus {
    border-color: #1e40af !important;
    box-shadow: 0 0 0 2px rgba(30, 64, 175, 0.1) !important;
    outline: none !important;
}

/* Results Container */
.select2-results {
    padding: 4px 0 !important;
}

.select2-results__options {
    max-height: 200px !important;
    overflow-y: auto !important;
}

/* Individual Options */
.select2-results__option {
    padding: 12px 16px !important;
    font-size: 14px !important;
    color: #374151 !important;
    background-color: #ffffff !important;
    cursor: pointer !important;
    border-bottom: 1px solid #f3f4f6 !important;
    transition: none !important;
}

.select2-results__option:last-child {
    border-bottom: none !important;
}

/* Highlighted Option (keyboard navigation) */
.select2-results__option--highlighted {
    background-color: #f8fafc !important;
    color: #1e40af !important;
}

/* Selected Option */
.select2-results__option[aria-selected="true"] {
    background-color: #eff6ff !important;
    color: #1e40af !important;
    font-weight: 500 !important;
}

/* No Results */
.select2-results__option--selectable {
    cursor: pointer !important;
}

.select2-results__message {
    padding: 12px 16px !important;
    color: #6b7280 !important;
    font-size: 14px !important;
    text-align: center !important;
}

/* Placeholder */
.select2-container--default .select2-selection--single .select2-selection__placeholder {
    color: #9ca3af !important;
    font-size: 14px !important;
}

/* Clear Button */
.select2-container--default .select2-selection__clear {
    cursor: pointer !important;
    float: right !important;
    font-weight: bold !important;
    margin-left: 10px !important;
    margin-right: 0px !important;
    color: #6b7280 !important;
}

.select2-container--default .select2-selection__clear:hover {
    color: #374151 !important;
}

/* Custom styling for our option template */
.select2-results__option .font-medium {
    font-weight: 500 !important;
    color: inherit !important;
}

.select2-results__option .text-sm.text-gray-500 {
    font-size: 12px !important;
    color: #6b7280 !important;
    margin-top: 2px !important;
    line-height: 1.3 !important;
}

/* Responsive adjustments */
@media (max-width: 640px) {
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding-left: 12px !important;
        padding-right: 40px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        right: 8px !important;
    }

    .select2-results__option {
        padding: 10px 12px !important;
    }
}
</style>
@endpush

@section('content')
<main class="flex-1" x-data="{ showDeleteModal: false, packageToDelete: null }">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4 md:mb-0">Daftar Paket Wisata</h2>
            <a href="{{ route('admin.packages.create') }}" class="px-4 py-2 bg-admin-primary text-white rounded-lg hover:bg-admin-secondary text-sm">+ Tambah Paket</a>
        </div>

        <!-- Filter & Search Form -->
        <form method="GET" action="{{ route('admin.packages.index') }}">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                <!-- Search Input -->
                <div class="relative md:col-span-2">
                    <input type="text" name="search" placeholder="Cari paket, kategori, atau rute..."
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

                <!-- Category Filter -->
                <div>
                    <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-admin-primary focus:border-admin-primary select2-category">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                    data-description="{{ $category->description ?? '' }}"
                                    {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center space-x-2">
                    <button type="submit" class="px-6 py-2 bg-admin-secondary text-white rounded-lg hover:bg-admin-primary transition-colors duration-200">
                        <span class="hidden sm:inline">Filter</span>
                        <svg class="w-4 h-4 sm:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.414A1 1 0 013 6.707V4z"></path>
                        </svg>
                    </button>
                    @if(request()->anyFilled(['search', 'category', 'price_min', 'price_max']))
                        <a href="{{ route('admin.packages.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200"
                           title="Reset filter">
                            <span class="hidden sm:inline">Reset</span>
                            <svg class="w-4 h-4 sm:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Price Range Filter -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Range Harga</label>
                    <div class="flex items-center space-x-2">
                        <input type="number" name="price_min" placeholder="Min (Rp)"
                               class="flex-1 px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-admin-primary focus:border-admin-primary"
                               value="{{ request('price_min') }}">
                        <span class="text-gray-500 text-sm">s/d</span>
                        <input type="number" name="price_max" placeholder="Max (Rp)"
                               class="flex-1 px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-admin-primary focus:border-admin-primary"
                               value="{{ request('price_max') }}">
                    </div>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Quick Filter</label>
                    <select onchange="quickPriceFilter(this.value)" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-admin-primary focus:border-admin-primary">
                        <option value="">Pilih Range</option>
                        <option value="0-200000">< 200rb</option>
                        <option value="200000-500000">200rb - 500rb</option>
                        <option value="500000-1000000">500rb - 1jt</option>
                        <option value="1000000-">> 1jt</option>
                    </select>
                </div>
            </div>

            <script>
                function quickPriceFilter(range) {
                    if (!range) return;

                    const [min, max] = range.split('-');
                    const minInput = document.querySelector('input[name="price_min"]');
                    const maxInput = document.querySelector('input[name="price_max"]');

                    minInput.value = min || '';
                    maxInput.value = max || '';
                }
            </script>

            <!-- Search Info Banner -->
            @if(request()->anyFilled(['search', 'category', 'price_min', 'price_max']))
                <div class="mb-4 px-4 py-2 bg-blue-50 border border-blue-200 rounded-lg">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm text-blue-700">
                                Filter aktif:
                                @if(request('search'))
                                    <strong>"{{ request('search') }}"</strong>
                                @endif
                                @if(request('category'))
                                    @php $selectedCategory = $categories->where('id', request('category'))->first(); @endphp
                                    <strong>{{ $selectedCategory?->name }}</strong>
                                @endif
                                @if(request('price_min') || request('price_max'))
                                    <strong>Rp {{ number_format(request('price_min', 0)) }} - Rp {{ number_format(request('price_max', 999999999)) }}</strong>
                                @endif
                            </span>
                        </div>
                        <a href="{{ route('admin.packages.index') }}"
                           class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            Hapus filter
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
                                $url = route('admin.packages.index', array_merge(request()->query(), ['sort' => $field, 'direction' => $direction]));
                                $icon = request('sort') == $field ? (request('direction') == 'asc' ? '&#9650;' : '&#9660;') : '';
                                return '<a href="'.$url.'" class="flex items-center space-x-1"><span>'.$label.'</span> <span class="text-xs">'.$icon.'</span></a>';
                            };
                        @endphp
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{!! $sortLink('name', 'Nama Paket') !!}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{!! $sortLink('category_name', 'Kategori') !!}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{!! $sortLink('price', 'Harga') !!}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{!! $sortLink('duration', 'Durasi') !!}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{!! $sortLink('created_at', 'Tanggal Dibuat') !!}</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($packages as $package)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div>
                                <div class="font-semibold text-sm text-gray-900">{{ $package->name }}</div>
                                <div class="text-xs text-gray-500 mt-1">{{ Str::limit($package->routes, 50) }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $package->category->name }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">Rp {{ number_format($package->price) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $package->duration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $package->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.packages.show', $package) }}"
                                   class="inline-flex items-center p-2 border border-transparent rounded-full shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                   title="Lihat Detail">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                                <a href="{{ route('admin.packages.edit', $package) }}"
                                   class="inline-flex items-center p-2 border border-transparent rounded-full shadow-sm text-white bg-admin-primary hover:bg-admin-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-admin-primary"
                                   title="Edit Paket">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <form method="POST" action="{{ route('admin.packages.destroy', $package) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                            @click="packageToDelete = { id: {{ $package->id }}, name: '{{ $package->name }}', route: '{{ route('admin.packages.destroy', $package) }}' }; showDeleteModal = true"
                                            class="inline-flex items-center p-2 border border-transparent rounded-full shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                            title="Hapus Paket">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-8 text-gray-500">Data tidak ditemukan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- END: Tampilan Tabel untuk Desktop -->

        <!-- START: Tampilan Kartu untuk Mobile -->
        <div class="block md:hidden space-y-4">
            @forelse($packages as $package)
                <div class="bg-white p-4 rounded-lg shadow-md border border-gray-200">
                    <div class="flex justify-between items-start mb-3">
                        <div class="font-bold text-base text-admin-primary">{{ $package->name }}</div>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">{{ $package->category->name }}</span>
                    </div>

                    <div class="text-sm text-gray-600 mb-3">{{ Str::limit($package->routes, 80) }}</div>

                    <div class="grid grid-cols-2 gap-4 text-sm mb-4">
                        <div>
                            <div class="text-gray-500">Harga</div>
                            <div class="font-medium text-admin-primary">Rp {{ number_format($package->price) }}</div>
                        </div>
                        <div>
                            <div class="text-gray-500">Durasi</div>
                            <div class="font-medium text-gray-800">{{ $package->duration }}</div>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-100 flex justify-end">
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('admin.packages.show', $package) }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                Detail
                            </a>
                            <a href="{{ route('admin.packages.edit', $package) }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-admin-primary hover:bg-admin-secondary">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.packages.destroy', $package) }}">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                        @click="packageToDelete = { id: {{ $package->id }}, name: '{{ $package->name }}', route: '{{ route('admin.packages.destroy', $package) }}' }; showDeleteModal = true"
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
            {{ $packages->withQueryString()->links() }}
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
                                <h3 class="text-base font-semibold text-gray-900" id="modal-title">Hapus Paket Wisata</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Apakah Anda yakin ingin menghapus paket "<span x-text="packageToDelete?.name || ''"></span>"? Semua data termasuk galeri foto akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <form method="POST" :action="packageToDelete?.route" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Hapus</button>
                        </form>
                        <button @click="showDeleteModal = false; packageToDelete = null" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-gray-300 ring-inset hover:bg-gray-50 sm:mt-0 sm:w-auto">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@push('scripts')
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize Select2 for category filter
    $('.select2-category').select2({
        placeholder: 'Semua Kategori',
        allowClear: true,
        width: '100%',
        templateResult: function(data) {
            if (!data.id) {
                return data.text;
            }

            // Get description from data attribute
            var $option = $(data.element);
            var description = $option.data('description');

            var $result = $('<div></div>');
            $result.append('<div class="font-medium">' + data.text + '</div>');

            if (description) {
                $result.append('<div class="text-sm text-gray-500">' + description + '</div>');
            }

            return $result;
        },
        templateSelection: function(data) {
            return data.text;
        }
    });
});
</script>
@endpush
@endsection

@extends('layouts.admin.app')
@section('title', 'Manajemen Paket Wisata')

@section('content')
<main class="flex-1" x-data="{ showDeleteModal: false, packageToDelete: null }">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4 md:mb-0">Daftar Paket Wisata</h2>
            <x-button variant="primary" icon="plus" :href="route('admin.packages.create')">
                Tambah Paket
            </x-button>
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
                    @if(request('search'))                    <div class="absolute inset-y-0 right-8 flex items-center pr-2">
                        <x-button variant="ghost"
                                  size="icon-sm"
                                  icon="close"
                                  onclick="document.getElementById('search-input').value=''; this.closest('form').submit();"
                                  title="Clear search" />
                    </div>
                    @endif
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <x-icon type="search" class="h-5 w-5 text-gray-400" />
                    </div>
                </div>

                <!-- Category Filter -->
                <div>
                    <x-select2 name="category"
                               placeholder="Semua Kategori"
                               :selected="request('category')"
                               :show-description="true">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                    data-description="{{ $category->description ?? '' }}"
                                    {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </x-select2>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center space-x-2">
                    <x-button variant="secondary" icon="filter" icon-only type="submit">
                        Filter
                    </x-button>

                    @if(request()->anyFilled(['search', 'category', 'price_min', 'price_max']))
                        <x-button variant="gray" icon="close" icon-only :href="route('admin.packages.index')" title="Reset filter">
                            Reset
                        </x-button>
                    @endif
                </div>
            </div>

            <!-- Price Range Filter -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Range Harga</label>
                    <div class="flex items-center space-x-2">
                        <!-- Hidden raw values for form submission -->
                        <input type="hidden" name="price_min" id="price_min_raw" value="{{ request('price_min') }}">
                        <input type="hidden" name="price_max" id="price_max_raw" value="{{ request('price_max') }}">

                        <!-- Visible formatted inputs -->
                        <input type="text" id="price_min_formatted" placeholder="Min (Rp)"
                               inputmode="numeric"
                               class="flex-1 px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-admin-primary focus:border-admin-primary"
                               value="{{ request('price_min') ? number_format(request('price_min'), 0, '', '.') : '' }}"
                               oninput="formatFilterCurrency(this, 'price_min_raw')" onchange="formatFilterCurrency(this, 'price_min_raw')">
                        <span class="text-gray-500 text-sm">s/d</span>
                        <input type="text" id="price_max_formatted" placeholder="Max (Rp)"
                               inputmode="numeric"
                               class="flex-1 px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-admin-primary focus:border-admin-primary"
                               value="{{ request('price_max') ? number_format(request('price_max'), 0, '', '.') : '' }}"
                               oninput="formatFilterCurrency(this, 'price_max_raw')" onchange="formatFilterCurrency(this, 'price_max_raw')">
                    </div>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Quick Filter</label>
                    <select id="quick-filter" onchange="quickPriceFilter(this.value)" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-admin-primary focus:border-admin-primary">
                        <option value="">Pilih Range</option>
                        <option value="0-200000" {{ request('price_min') == '0' && request('price_max') == '200000' ? 'selected' : '' }}>< 200rb</option>
                        <option value="200000-500000" {{ request('price_min') == '200000' && request('price_max') == '500000' ? 'selected' : '' }}>200rb - 500rb</option>
                        <option value="500000-1000000" {{ request('price_min') == '500000' && request('price_max') == '1000000' ? 'selected' : '' }}>500rb - 1jt</option>
                        <option value="1000000-" {{ request('price_min') == '1000000' && empty(request('price_max')) ? 'selected' : '' }}>> 1jt</option>
                    </select>
                </div>
            </div>

            <!-- Search Info Banner -->
            @if(request()->anyFilled(['search', 'category', 'price_min', 'price_max']))
                <x-alert type="info" class="mb-4">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <div class="flex flex-wrap items-center text-left">
                            <span class="text-sm">
                                <strong>Filter aktif:</strong>
                                @if(request('search'))
                                    "{{ request('search') }}"
                                @endif
                                @if(request('category'))
                                    @php $selectedCategory = $categories->where('id', request('category'))->first(); @endphp
                                    {{ $selectedCategory?->name }}
                                @endif
                                @if(request('price_min') || request('price_max'))
                                    @if(request('price_min') && request('price_max'))
                                        Rp {{ number_format(request('price_min')) }} - Rp {{ number_format(request('price_max')) }}
                                    @elseif(request('price_min'))
                                        > Rp {{ number_format(request('price_min')) }}
                                    @else
                                        < Rp {{ number_format(request('price_max')) }}
                                    @endif
                                @endif
                            </span>
                        </div>
                        <a href="{{ route('admin.packages.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium whitespace-nowrap">
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
                                <div class="text-xs text-gray-500 mt-1">{{ Str::limit(strip_tags($package->description ?? $package->routes ?? ''), 50) }}</div>
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $package->created_at ? $package->created_at->format('d M Y') : '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="action-buttons-group desktop">
                                <!-- Detail Button -->
                                <a href="{{ route('admin.packages.show', $package) }}"
                                   class="action-btn-icon action-btn-view"
                                   title="Lihat Detail">
                                    <x-icon name="eye" class="w-4 h-4" />
                                </a>

                                <!-- Edit Button -->
                                <a href="{{ route('admin.packages.edit', $package) }}"
                                   class="action-btn-icon action-btn-edit"
                                   title="Edit">
                                    <x-icon name="edit" class="w-4 h-4" />
                                </a>

                                <!-- Delete Button -->
                                <button type="button"
                                        @click="packageToDelete = { id: {{ $package->id }}, name: '{{ $package->name }}', route: '{{ route('admin.packages.destroy', $package) }}' }; showDeleteModal = true"
                                        class="action-btn-icon action-btn-delete"
                                        title="Hapus">
                                    <x-icon name="delete" class="w-4 h-4" />
                                </button>
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

                    <div class="text-sm text-gray-600 mb-3">{{ Str::limit(strip_tags($package->description ?? $package->routes ?? ''), 80) }}</div>

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
                        <div class="action-buttons-group mobile">
                            <!-- Detail Button -->
                            <a href="{{ route('admin.packages.show', $package) }}"
                               class="action-btn-text action-btn-view">
                                <x-icon name="eye" class="w-4 h-4 mr-1" />
                                Detail
                            </a>

                            <!-- Edit Button -->
                            <a href="{{ route('admin.packages.edit', $package) }}"
                               class="action-btn-text action-btn-edit">
                                <x-icon name="edit" class="w-4 h-4 mr-1" />
                                Edit
                            </a>

                            <!-- Delete Button -->
                            <button type="button"
                                    @click="packageToDelete = { id: {{ $package->id }}, name: '{{ $package->name }}', route: '{{ route('admin.packages.destroy', $package) }}' }; showDeleteModal = true"
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
                {{ $packages->appends(request()->query())->links('vendor.pagination.custom-theme') }}
            </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <x-delete-modal show="showDeleteModal"
                    item="packageToDelete"
                    title="Hapus Paket Wisata">
        <p>Apakah Anda yakin ingin menghapus paket "<strong x-text="packageToDelete?.name || ''"></strong>"?
        Semua data termasuk galeri foto akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.</p>
    </x-delete-modal>
</main>

@push('scripts')
<script>
// Function to format currency for filter inputs
function formatFilterCurrency(el, hiddenInputId) {
    // Remove non-digit characters
    let digits = el.value.replace(/\D/g, '');

    // Update raw hidden input
    document.getElementById(hiddenInputId).value = digits;

    // Format for display
    if (digits) {
        el.value = new Intl.NumberFormat('id-ID').format(digits);
    } else {
        el.value = '';
    }
}

function quickPriceFilter(range) {
    if (!range) {
        // Clear inputs when no range selected
        document.getElementById('price_min_raw').value = '';
        document.getElementById('price_max_raw').value = '';
        document.getElementById('price_min_formatted').value = '';
        document.getElementById('price_max_formatted').value = '';
        return;
    }

    const [min, max] = range.split('-');
    const minInput = document.getElementById('price_min_raw');
    const maxInput = document.getElementById('price_max_raw');
    const minFormatted = document.getElementById('price_min_formatted');
    const maxFormatted = document.getElementById('price_max_formatted');

    // Set raw values
    minInput.value = min || '';
    maxInput.value = max || '';

    // Set formatted values
    if (min) {
        minFormatted.value = new Intl.NumberFormat('id-ID').format(min);
    } else {
        minFormatted.value = '';
    }

    if (max) {
        maxFormatted.value = new Intl.NumberFormat('id-ID').format(max);
    } else {
        maxFormatted.value = '';
    }
}

// Initialize formatting on page load
document.addEventListener('DOMContentLoaded', function() {
    const priceMinFormatted = document.getElementById('price_min_formatted');
    const priceMaxFormatted = document.getElementById('price_max_formatted');

    if (priceMinFormatted && priceMinFormatted.value) {
        formatFilterCurrency(priceMinFormatted, 'price_min_raw');
    }
    if (priceMaxFormatted && priceMaxFormatted.value) {
        formatFilterCurrency(priceMaxFormatted, 'price_max_raw');
    }

    // Ensure form submission uses raw values
    const filterForm = document.querySelector('form[method="GET"]');
    if (filterForm) {
        filterForm.addEventListener('submit', function(e) {
            // Make sure hidden inputs have the correct raw values
            const minFormatted = document.getElementById('price_min_formatted');
            const maxFormatted = document.getElementById('price_max_formatted');

            if (minFormatted) {
                const minDigits = minFormatted.value.replace(/\D/g, '');
                document.getElementById('price_min_raw').value = minDigits;
            }

            if (maxFormatted) {
                const maxDigits = maxFormatted.value.replace(/\D/g, '');
                document.getElementById('price_max_raw').value = maxDigits;
            }
        });
    }
});
</script>
@endpush

@endsection

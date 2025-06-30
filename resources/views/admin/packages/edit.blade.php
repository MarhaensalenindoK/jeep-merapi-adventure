@extends('layouts.admin.app')
@section('title', 'Edit Paket Wisata')

@php
    $breadcrumbs = [
        ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['title' => 'Manajemen Paket', 'url' => route('admin.packages.index')],
        ['title' => 'Edit Paket'],
    ];
@endphp

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
<main class="flex-1 p-6">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4 md:mb-0">Edit Paket: {{ $package->name }}</h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.packages.show', $package) }}" class="px-4 py-2 rounded-lg hover:text-gray-700 text-sm inline-flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    <span class="hidden sm:inline">Lihat</span>
                </a>
                <a href="{{ route('admin.packages.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 text-sm">
                    ← Kembali
                </a>
            </div>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.packages.update', $package) }}" x-data="{
            name: '{{ old('name', $package->name) }}',
            generateSlug() {
                return this.name.toLowerCase()
                    .replace(/[^a-z0-9 -]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .trim('-');
            }
        }">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-4">
                    <!-- Kategori -->
                    <div>
                        <label for="package_category_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Kategori Paket <span class="text-red-500">*</span>
                        </label>
                        <select name="package_category_id" id="package_category_id"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-admin-primary focus:border-admin-primary select2-category"
                                required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                        data-description="{{ $category->description ?? '' }}"
                                        {{ old('package_category_id', $package->package_category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-sm text-gray-500 mt-1">Ketik untuk mencari kategori</p>
                    </div>

                    <!-- Nama Paket -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Paket <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name"
                               x-model="name"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-admin-primary focus:border-admin-primary"
                               value="{{ old('name', $package->name) }}" required>
                    </div>

                    <!-- Current & Preview Slug -->
                    <div class="space-y-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">Slug Saat Ini:</label>
                            <div class="px-4 py-2 bg-gray-100 rounded-lg text-sm text-gray-600 border">{{ $package->slug }}</div>
                        </div>
                        <div x-show="name !== '{{ $package->name }}'">
                            <label class="block text-sm font-medium text-gray-500 mb-2">Preview Slug Baru:</label>
                            <div class="px-4 py-2 bg-yellow-100 rounded-lg text-sm text-gray-600 border-2 border-dashed border-yellow-300"
                                 x-text="generateSlug()"></div>
                        </div>
                    </div>

                    <!-- Short Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi Singkat
                        </label>
                        <textarea name="description" id="description-editor" rows="3"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-admin-primary focus:border-admin-primary"
                                  placeholder="Deskripsi singkat paket wisata (optional)">{{ old('description', $package->description) }}</textarea>
                        <p class="text-sm text-gray-500 mt-1">Deskripsi singkat untuk preview di halaman paket</p>
                    </div>

                    <!-- Is Active -->
                    <div>
                        <div class="flex items-center">
                            <input type="checkbox" id="is_active" name="is_active" value="1"
                                   class="h-4 w-4 text-admin-primary focus:ring-admin-primary border-gray-300 rounded"
                                   {{ old('is_active', $package->is_active) ? 'checked' : '' }}>
                            <label for="is_active" class="ml-2 block text-sm text-gray-700">
                                Paket Aktif
                            </label>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">Centang untuk mengaktifkan paket di halaman publik</p>
                    </div>

                    <!-- Harga -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                            Harga (Rp) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="price" id="price"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-admin-primary focus:border-admin-primary"
                               value="{{ old('price', $package->price) }}" min="0" required
                               oninput="updatePricePreview(this.value)">
                        <p class="text-sm text-gray-500 mt-1">Masukkan harga dalam Rupiah</p>
                        <div id="price-preview" class="text-sm text-blue-600 font-medium mt-1"></div>
                    </div>

                    <script>
                        function updatePricePreview(value) {
                            const preview = document.getElementById('price-preview');
                            if (value && value > 0) {
                                const formatted = new Intl.NumberFormat('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                }).format(value);
                                preview.textContent = `Preview: ${formatted}`;
                            } else {
                                preview.textContent = '';
                            }
                        }

                        // Show initial preview
                        document.addEventListener('DOMContentLoaded', function() {
                            const priceInput = document.getElementById('price');
                            updatePricePreview(priceInput.value);
                        });
                    </script>

                    <!-- Durasi -->
                    <div>
                        <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">
                            Durasi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="duration" id="duration"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-admin-primary focus:border-admin-primary"
                               value="{{ old('duration', $package->duration) }}"
                               placeholder="Contoh: 2 Hari 1 Malam" required>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-4">
                    <!-- Rute Perjalanan -->
                    <div>
                        <label for="routes" class="block text-sm font-medium text-gray-700 mb-2">
                            Rute Perjalanan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="routes" id="routes-editor" rows="4"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-admin-primary focus:border-admin-primary"
                                  placeholder="Deskripsikan rute perjalanan..." required>{{ old('routes', $package->routes) }}</textarea>
                    </div>

                    <!-- Deskripsi Lengkap -->
                    <div>
                        <label for="full_description" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi Lengkap
                        </label>
                        <textarea name="full_description" id="full-description-editor" rows="6"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-admin-primary focus:border-admin-primary"
                                  placeholder="Deskripsi detail paket wisata...">{{ old('full_description', $package->full_description) }}</textarea>
                    </div>

                    <!-- Metadata -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Informasi Metadata</h4>
                        <div class="space-y-1 text-sm text-gray-600">
                            <p><strong>Dibuat:</strong> {{ $package->created_at->format('d/m/Y H:i') }}</p>
                            @if($package->createdByUser)
                                <p><strong>Oleh:</strong> {{ $package->createdByUser->name }}</p>
                            @endif
                            @if($package->updated_at != $package->created_at)
                                <p><strong>Terakhir diubah:</strong> {{ $package->updated_at->format('d/m/Y H:i') }}</p>
                                @if($package->updatedByUser)
                                    <p><strong>Oleh:</strong> {{ $package->updatedByUser->name }}</p>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex flex-col gap-3 sm:flex-row sm:justify-end sm:gap-4">
                    <a href="{{ route('admin.packages.index') }}"
                       class="w-full sm:w-auto px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-center inline-flex items-center justify-center">
                        Batal
                    </a>
                    <button type="submit"
                            class="w-full sm:w-auto px-6 py-2 bg-admin-primary text-white rounded-lg hover:bg-admin-secondary inline-flex items-center justify-center">
                        Update Paket
                    </button>
                </div>
            </div>
        </form>
    </div>
</main>

@push('scripts')
<!-- CKEditor CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    // Wait for CKEditor to be available
    function initializeCKEditors() {
        if (typeof ClassicEditor === 'undefined') {
            console.log('CKEditor not ready, retrying...');
            setTimeout(initializeCKEditors, 100);
            return;
        }

        // Initialize CKEditor for description
        const descriptionEditor = document.querySelector('#description-editor');
        if (descriptionEditor) {
            ClassicEditor
                .create(descriptionEditor, {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', '|', 'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|', 'blockQuote', 'insertTable', '|', 'undo', 'redo']
                })
                .catch(error => {
                    console.error('Error initializing description editor:', error);
                });
        }

        // Initialize CKEditor for routes
        const routesEditor = document.querySelector('#routes-editor');
        if (routesEditor) {
            ClassicEditor
                .create(routesEditor, {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', '|', 'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|', 'blockQuote', 'insertTable', '|', 'undo', 'redo']
                })
                .catch(error => {
                    console.error('Error initializing routes editor:', error);
                });
        }

        // Initialize CKEditor for full_description
        const fullDescriptionEditor = document.querySelector('#full-description-editor');
        if (fullDescriptionEditor) {
            ClassicEditor
                .create(fullDescriptionEditor, {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', '|', 'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|', 'blockQuote', 'insertTable', '|', 'undo', 'redo']
                })
                .catch(error => {
                    console.error('Error initializing full description editor:', error);
                });
        }
    }

    // Initialize CKEditors
    initializeCKEditors();

    // Initialize Select2 for category
    $('.select2-category').select2({
        placeholder: 'Pilih Kategori',
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

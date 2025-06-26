@extends('layouts.admin.app')
@section('title', 'Tambah Artikel')

@php
    $breadcrumbs = [
        ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['title' => 'Manajemen Blog', 'url' => route('admin.posts.index')],
        ['title' => 'Tambah Artikel'],
    ];
@endphp

@push('styles')
<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
@endpush

@section('content')
<main class="flex-1">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-bold text-gray-900">Tambah Artikel</h2>
            <x-button variant="outline" icon="arrow-left" :href="route('admin.posts.index')">
                Kembali
            </x-button>
        </div>

        <!-- Alert Messages -->
        @if($errors->any())
        <x-alert type="error" class="mb-4">
            <p class="font-medium">Terjadi kesalahan:</p>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-alert>
        @endif

        <!-- Info Alert -->
        <x-alert type="info" class="mb-6">
            <p class="font-medium">Tips Menulis Artikel:</p>
            <ul class="mt-2 list-disc list-inside text-sm">
                <li>Gunakan judul yang menarik dan SEO friendly</li>
                <li>Format gambar: JPEG, PNG, JPG, WebP maksimal 15MB</li>
                <li>Slug akan dibuat otomatis jika tidak diisi</li>
                <li>Artikel akan disimpan sebagai draft jika tidak dipublikasi</li>
            </ul>
        </x-alert>

        <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data" x-data="{}"
              onsubmit="return validateForm()">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column: Featured Image -->
                <div class="lg:col-span-1">
                    <div class="space-y-4">
                        <!-- Featured Image Upload -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Gambar Utama (Opsional)
                            </label>
                            <!-- Main file input (always present but may be hidden) -->
                            <input id="featured_image" name="featured_image" type="file" accept="image/*" class="sr-only"
                                   @change="$store.post.previewImage($event)">

                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition-colors"
                                 @drop="$store.post.handleFileDrop($event)"
                                 @dragover.prevent
                                 @dragenter.prevent>
                                <div class="space-y-1 text-center">
                                    <div x-show="!$store.post.imagePreview">
                                        <x-icon name="image" class="mx-auto h-12 w-12 text-gray-400" />
                                        <div class="flex flex-wrap justify-center text-sm text-gray-600">
                                            <label for="featured_image" class="relative cursor-pointer bg-white rounded-md font-medium text-admin-primary hover:text-admin-secondary focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-admin-primary">
                                                <span>Upload gambar</span>
                                            </label>
                                            <p class="pl-1"> atau drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, WebP hingga 15MB</p>
                                    </div>
                                    <div x-show="$store.post.imagePreview" class="relative">
                                        <img :src="$store.post.imagePreview" class="mx-auto max-h-48 rounded-lg" alt="Preview">
                                        <button @click="$store.post.clearPreview()" type="button"
                                                class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition-colors">
                                            <x-icon name="close" class="h-4 w-4" />
                                        </button>
                                        <div class="mt-2">
                                            <label for="featured_image" class="cursor-pointer bg-white border border-gray-300 rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-admin-primary">
                                                Ganti Gambar
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @error('featured_image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Right Column: Form Fields -->
                <div class="lg:col-span-2">
                    <div class="space-y-6">
                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                Judul Artikel <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="title" name="title"
                                   class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-admin-primary focus:border-admin-primary"
                                   value="{{ old('title') }}" required maxlength="255"
                                   placeholder="Masukkan judul artikel yang menarik">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Slug -->
                        <div>
                            <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                                Slug URL
                            </label>
                            <input type="text" id="slug" name="slug"
                                   class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-admin-primary focus:border-admin-primary"
                                   value="{{ old('slug') }}" maxlength="255"
                                   placeholder="slug-artikel (akan dibuat otomatis jika kosong)">
                            <p class="mt-1 text-sm text-gray-500">Format: huruf kecil, strip, tanpa spasi</p>
                            @error('slug')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Author -->
                        <div>
                            <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Penulis <span class="text-red-500">*</span>
                            </label>
                            <x-select2 name="user_id"
                                       placeholder="Pilih penulis"
                                       :selected="old('user_id', auth()->id())">
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}" {{ old('user_id', auth()->id()) == $author->id ? 'selected' : '' }}>
                                        {{ $author->name }}
                                    </option>
                                @endforeach
                            </x-select2>
                            @error('user_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div>
                            <label for="body" class="block text-sm font-medium text-gray-700 mb-2">
                                Konten Artikel <span class="text-red-500">*</span>
                            </label>
                            <textarea id="body" name="body" rows="12"
                                      class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-admin-primary focus:border-admin-primary"
                                      placeholder="Tulis konten artikel di sini...">{{ old('body') }}</textarea>
                            @error('body')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Publishing Options -->
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h4 class="text-sm font-medium text-gray-700 mb-4">Opsi Publikasi</h4>

                            <div class="space-y-4">
                                <!-- Publish Checkbox -->
                                <div class="flex items-center">
                                    <input type="checkbox" id="is_published" name="is_published" value="1"
                                           class="h-4 w-4 text-admin-primary focus:ring-admin-primary border-gray-300 rounded"
                                           {{ old('is_published') ? 'checked' : '' }}>
                                    <label for="is_published" class="ml-2 block text-sm text-gray-700">
                                        Publikasikan artikel sekarang
                                    </label>
                                </div>

                                <!-- Custom Publish Date -->
                                <div x-data="{ showCustomDate: false }">
                                    <div class="flex items-center">
                                        <input type="checkbox" id="custom_date" @change="showCustomDate = !showCustomDate"
                                               class="h-4 w-4 text-admin-primary focus:ring-admin-primary border-gray-300 rounded">
                                        <label for="custom_date" class="ml-2 block text-sm text-gray-700">
                                            Atur tanggal publikasi manual
                                        </label>
                                    </div>

                                    <div x-show="showCustomDate" class="mt-2">
                                        <input type="datetime-local" id="published_at" name="published_at"
                                               class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-admin-primary focus:border-admin-primary"
                                               value="{{ old('published_at') }}">
                                        @error('published_at')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-6 sm:mt-4 flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3">
                <x-button variant="outline" icon="arrow-left" :href="route('admin.posts.index')" type="button">
                    Batal
                </x-button>
                <x-button variant="primary" icon="check" type="submit">
                    Simpan Artikel
                </x-button>
            </div>
        </form>
    </div>
</main>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.store('post', {
        imagePreview: null,

        previewImage(event) {
            const file = event.target.files[0];
            if (file && file.type.startsWith('image/')) {
                // Check file size (15MB = 15 * 1024 * 1024 bytes)
                if (file.size > 15 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar. Maksimal 15MB.');
                    return;
                }

                const reader = new FileReader();
                reader.onload = (e) => {
                    this.imagePreview = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },

        clearPreview() {
            this.imagePreview = null;
            const imageInput = document.getElementById('featured_image');
            if (imageInput) imageInput.value = '';
        },

        handleFileDrop(event) {
            event.preventDefault();
            const files = event.dataTransfer.files;
            if (files.length > 0) {
                const file = files[0];
                if (file.type.startsWith('image/')) {
                    // Set the file to the input
                    const imageInput = document.getElementById('featured_image');
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    imageInput.files = dataTransfer.files;

                    // Preview the image
                    this.previewImage({target: {files: [file]}});
                } else {
                    alert('File harus berupa gambar (JPEG, PNG, JPG, WebP)');
                }
            }
        }
    });
});

// Form validation function
function validateForm() {
    // Sync CKEditor content to textarea
    if (window.bodyEditor) {
        const content = window.bodyEditor.getData();
        document.getElementById('body').value = content;

        // Check if content is empty
        if (!content.trim()) {
            alert('Konten artikel tidak boleh kosong.');
            return false;
        }
    }
    return true;
}

// Initialize CKEditor when document is ready
document.addEventListener('DOMContentLoaded', function() {
    ClassicEditor
        .create(document.querySelector('#body'), {
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', 'underline', '|',
                    'bulletedList', 'numberedList', '|',
                    'outdent', 'indent', '|',
                    'alignment', '|',
                    'link', 'blockQuote', '|',
                    'undo', 'redo'
                ]
            },
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                ]
            },
            alignment: {
                options: ['left', 'center', 'right', 'justify']
            },
            ui: {
                poweredBy: {
                    position: 'inside',
                    side: 'right',
                    label: null
                }
            }
        })
        .then(editor => {
            // Store editor instance for later use
            window.bodyEditor = editor;

            // Auto-sync content to textarea on change
            editor.model.document.on('change:data', () => {
                document.getElementById('body').value = editor.getData();
            });
        })
        .catch(error => {
            console.error('CKEditor error:', error);
        });
});
</script>
@endsection

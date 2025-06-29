@extends('layouts.public.app')

@section('title', 'Galeri - Jeep Merapi Adventure')
@section('description', 'Saksikan momen-momen tak terlupakan dari perjalanan wisata bersama Jeep Merapi Adventure melalui koleksi foto dan video terbaik.')

@section('content')
<div x-data="{
    currentImageIndex: 0,
    showModal: false,
    images: [
        @foreach($galleries as $gallery)
            @if(file_exists(public_path('storage/' . $gallery->image_path)))
            {
                src: '{{ asset('storage/' . $gallery->image_path) }}',
                alt: '{{ $gallery->alt_text ?? $gallery->title }}',
                title: '{{ $gallery->title }}',
                package: '{{ $gallery->package ? $gallery->package->name : 'Umum' }}'
            },
            @endif
        @endforeach
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

<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-purple-800 to-purple-600 text-white py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6" data-aos="fade-up">
                Galeri Petualangan
            </h1>
            <p class="text-xl text-purple-100" data-aos="fade-up" data-aos-delay="200">
                Saksikan momen-momen tak terlupakan dari perjalanan wisata bersama kami.
            </p>
        </div>
    </div>
</section>

<!-- Filters Section -->
@if($packages->count() > 0)
<section class="py-8 bg-gray-50 border-b">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('gallery.index') }}"
               class="px-4 py-2 rounded-full text-sm font-medium transition-colors {{ !request('package') ? 'bg-purple-600 text-white' : 'bg-white text-gray-700 hover:bg-purple-50' }}">
                Semua Foto
            </a>
            @foreach($packages as $package)
            <a href="{{ route('gallery.index', ['package' => $package->slug]) }}"
               class="px-4 py-2 rounded-full text-sm font-medium transition-colors {{ request('package') === $package->slug ? 'bg-purple-600 text-white' : 'bg-white text-gray-700 hover:bg-purple-50' }}">
                {{ $package->name }}
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Gallery Grid -->
@if($galleries->count() > 0)
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @php $imageIndex = 0; @endphp
            @foreach($galleries as $gallery)
                @if(file_exists(public_path('storage/' . $gallery->image_path)))
                <div class="group relative overflow-hidden rounded-lg bg-gray-200 aspect-square cursor-pointer"
                     @click="openModal({{ $imageIndex }})"
                     data-aos="fade-up"
                     data-aos-delay="{{ ($imageIndex % 8) * 100 }}">
                    <img src="{{ asset('storage/' . $gallery->image_path) }}"
                         alt="{{ $gallery->alt_text ?? $gallery->title }}"
                         class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">

                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-center">
                            <div class="text-white">
                                <svg class="w-8 h-8 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.293l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-sm font-medium">Lihat Foto</p>
                            </div>
                        </div>
                    </div>

                    <!-- Image Info -->
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-4">
                        <h3 class="text-white text-sm font-medium">{{ $gallery->title }}</h3>
                        @if($gallery->package)
                        <p class="text-gray-300 text-xs mt-1">{{ $gallery->package->name }}</p>
                        @endif
                    </div>
                </div>
                @php $imageIndex++; @endphp
                @endif
            @endforeach
        </div>

        <!-- Pagination -->
        @if($galleries->hasPages())
        <div class="mt-12">
            <!-- Pagination Links -->
            <div>
                {{ $galleries->appends(request()->query())->links() }}
            </div>
        </div>
        @endif
    </div>
</section>
@else
<!-- Empty State -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto text-center">
            <div class="text-gray-400 mb-6">
                <svg class="w-20 h-20 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">
                Belum Ada Foto
            </h2>
            <p class="text-gray-600 mb-8">
                {{ request('package') ? 'Belum ada foto untuk paket ini.' : 'Belum ada foto di galeri.' }}
                Segera akan ada koleksi foto petualangan yang menakjubkan!
            </p>
            <a href="{{ route('home') }}"
               class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</section>
@endif

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
                            class="inline-flex w-full justify-center rounded-md bg-purple-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-purple-500 sm:ml-3 sm:w-auto">
                        Tutup
                    </button>
                    <a href="{{ route('packages.index') }}"
                       class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-gray-300 ring-inset hover:bg-gray-50 sm:mt-0 sm:w-auto">
                        Lihat Paket Wisata
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@endsection

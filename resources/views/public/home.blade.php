@extends('layouts.public.app')

@section('title', 'Jeep Merapi Adventure - Wisata Merapi Terpercaya')
@section('description', 'Jelajahi keindahan Gunung Merapi dengan paket wisata terpercaya. Pengalaman tak terlupakan menanti Anda bersama Jeep Merapi Adventure di Yogyakarta.')
@section('keywords', 'jeep merapi, wisata merapi, gunung merapi, yogyakarta, adventure, paket wisata, wisata alam')

@section('content')
<div x-data="{
    currentImageIndex: 0,
    showModal: false,
    images: [
        @foreach($featuredGalleries as $gallery)
            @if(file_exists(public_path('storage/' . $gallery->image_path)))
            {
                src: '{{ asset('storage/' . $gallery->image_path) }}',
                alt: '{{ $gallery->alt_text ?? $gallery->title }}',
                title: '{{ $gallery->title }}'
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
<section class="relative bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 text-white overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat opacity-40"
         style="background-image: url('{{ asset('banner.JPG') }}');">
    </div>

    <!-- Content -->
    <div class="relative z-10 container mx-auto px-4 py-20 lg:py-32">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight" data-aos="fade-up">
                Jelajahi Keindahan
                <span class="text-green-400">Gunung Merapi</span>
            </h1>
            <div class="text-xl md:text-2xl mb-8 text-gray-200 leading-relaxed" data-aos="fade-up" data-aos-delay="200">
                <div id="typewriter-text"></div>
            </div>
            <div class="flex flex-col sm:flex-row gap-4 justify-center" data-aos="fade-up" data-aos-delay="400">
                <a href="{{ route('packages.index') }}"
                   class="bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-lg text-lg font-semibold transition-all duration-300 transform hover:scale-105 inline-flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                    </svg>
                    Lihat Paket Tour
                </a>
                <a href="https://wa.me/6281809769095?text=Halo,%20saya%20tertarik%20dengan%20paket%20wisata%20Jeep%20Merapi%20Adventure"
                   target="_blank"
                   class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-gray-900 px-8 py-4 rounded-lg text-lg font-semibold transition-all duration-300 inline-flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                    </svg>
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 text-white animate-bounce">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
        </svg>
    </div>
</section>

<!-- Features Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-2" data-aos="fade-up">
                Mengapa Memilih Kami?
            </h2>
            <p class="text-center text-gray-600 mb-12" data-aos="fade-up" data-aos-delay="100">
                Komitmen kami untuk memberikan pengalaman terbaik bagi petualangan Anda.
            </p>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Feature 1 -->
                <div class="text-center p-6 bg-white rounded-lg shadow-lg" data-aos="fade-up" data-aos-delay="200">
                    <div class="mb-4">
                        <div class="inline-block p-4 bg-green-100 rounded-full">
                            <x-icon name="shield-check" class="w-8 h-8 text-green-600" />
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Jeep Sesuai Standar</h3>
                    <p class="text-gray-600">Armada kami telah memenuhi standar operasional dari Dishub Yogyakarta untuk keamanan Anda.</p>
                </div>
                <!-- Feature 2 -->
                <div class="text-center p-6 bg-white rounded-lg shadow-lg" data-aos="fade-up" data-aos-delay="300">
                    <div class="mb-4">
                        <div class="inline-block p-4 bg-green-100 rounded-full">
                            <x-icon name="user-group" class="w-8 h-8 text-green-600" />
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Driver Berpengalaman</h3>
                    <p class="text-gray-600">Driver kami profesional, ramah, dan menguasai medan Merapi dengan sangat baik.</p>
                </div>
                <!-- Feature 3 -->
                <div class="text-center p-6 bg-white rounded-lg shadow-lg" data-aos="fade-up" data-aos-delay="400">
                    <div class="mb-4">
                        <div class="inline-block p-4 bg-green-100 rounded-full">
                            <x-icon name="language" class="w-8 h-8 text-green-600" />
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Driver Berbahasa Asing</h3>
                    <p class="text-gray-600">Beberapa driver kami mampu berkomunikasi dalam bahasa asing untuk melayani wisatawan mancanegara.</p>
                </div>
                <!-- Feature 4 -->
                <div class="text-center p-6 bg-white rounded-lg shadow-lg" data-aos="fade-up" data-aos-delay="500">
                    <div class="mb-4">
                        <div class="inline-block p-4 bg-green-100 rounded-full">
                            <x-icon name="sparkles" class="w-8 h-8 text-green-600" />
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Fasilitas Lengkap</h3>
                    <p class="text-gray-600">Basecamp kami dekat dengan masjid dan memiliki area parkir yang luas dan aman.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Packages Section -->
@if($featuredPackages->count() > 0)
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Paket Tour Populer
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Pilih paket wisata sesuai dengan preferensi dan waktu yang Anda miliki.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredPackages as $index => $package)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                @if($package->galleries->first())
                    <div class="relative h-48 bg-gray-200">
                        <img src="{{ asset('storage/' . $package->galleries->first()->image_path) }}"
                             alt="{{ $package->name }}"
                             class="w-full h-full object-cover">
                        <div class="absolute top-4 left-4">
                            <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                                {{ $package->category->name }}
                            </span>
                        </div>
                    </div>
                @else
                    <div class="h-48 bg-gray-200 flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                @endif

                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $package->name }}</h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">{{ Str::limit(strip_tags($package->description), 120) }}</p>

                    <div class="mb-4">
                        <div class="text-sm text-gray-400 line-through">
                            Rp {{ number_format($package->original_price, 0, ',', '.') }}
                        </div>
                        <div class="text-lg font-bold text-green-600">
                            Rp {{ number_format($package->promo_price, 0, ',', '.') }}
                        </div>
                        <div class="text-xs bg-red-500 text-white px-2 py-1 rounded-full inline-block mt-1">
                            Hemat {{ $package->discount_percentage }}%
                        </div>
                    </div>
                    <div class="text-sm text-gray-500 mb-4">
                        / {{ $package->duration }}
                    </div>

                    <a href="{{ route('packages.show', $package) }}"
                       class="block w-full bg-green-600 hover:bg-green-700 text-white text-center py-3 rounded-lg font-medium transition-colors">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('packages.index') }}"
               class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-medium transition-colors inline-flex items-center">
                Lihat Semua Paket
                <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Gallery Section -->
@if($featuredGalleries->filter(function($gallery) { return file_exists(public_path('storage/' . $gallery->image_path)); })->count() > 0)
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Galeri Petualangan
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Saksikan momen-momen tak terlupakan dari perjalanan wisata bersama kami.
            </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @php $imageIndex = 0; @endphp
            @foreach($featuredGalleries as $gallery)
                @if(file_exists(public_path('storage/' . $gallery->image_path)))
                <div class="relative group overflow-hidden rounded-lg aspect-square cursor-pointer"
                     data-aos="zoom-in"
                     data-aos-delay="{{ ($imageIndex + 1) * 100 }}"
                     @click="openModal({{ $imageIndex }})">
                    <img src="{{ asset('storage/' . $gallery->image_path) }}"
                         alt="{{ $gallery->alt_text ?? $gallery->title }}"
                         class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-300 flex items-center justify-center pointer-events-none">
                        <div class="opacity-0 group-hover:opacity-100 text-white text-center transition-opacity">
                            <svg class="w-8 h-8 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-sm">{{ $gallery->title }}</p>
                        </div>
                    </div>
                </div>
                @php $imageIndex++; @endphp
                @endif
            @endforeach
        </div>



        <div class="text-center mt-12">
            <a href="{{ route('gallery.index') }}"
               class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-medium transition-colors inline-flex items-center">
                Lihat Galeri Lengkap
                <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Gallery Slider Section -->
@if($additionalGalleries->count() > 0)
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Galeri Lengkap
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Jelajahi lebih banyak momen perjalanan wisata kami dalam galeri lengkap ini.
            </p>
        </div>

        <!-- Swiper Slider -->
        <div class="relative" data-aos="fade-up" data-aos-delay="200">
            <div class="swiper gallerySwiper">
                <div class="swiper-wrapper">
                    @foreach($additionalGalleries as $gallery)
                        @if(file_exists(public_path('storage/' . $gallery->image_path)))
                        <div class="swiper-slide">
                            <div class="relative group overflow-hidden rounded-lg aspect-[4/3] cursor-pointer">
                                <img src="{{ asset('storage/' . $gallery->image_path) }}"
                                     alt="{{ $gallery->alt_text ?? $gallery->title }}"
                                     class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-300 flex items-center justify-center">
                                    <div class="opacity-0 group-hover:opacity-100 text-white text-center transition-opacity">
                                        <svg class="w-8 h-8 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                        </svg>
                                        <p class="text-sm font-medium">{{ $gallery->title }}</p>
                                        @if($gallery->package)
                                            <p class="text-xs text-gray-300">{{ $gallery->package->name }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Navigation buttons -->
            <div class="swiper-button-next !text-green-600 !bg-white !bg-opacity-80 !rounded-full !w-10 !h-10 after:!text-sm !shadow-lg"></div>
            <div class="swiper-button-prev !text-green-600 !bg-white !bg-opacity-80 !rounded-full !w-10 !h-10 after:!text-sm !shadow-lg"></div>

            <!-- Pagination -->
            <div class="swiper-pagination !bottom-[-50px]"></div>
        </div>

        <div class="text-center mt-16">
            <a href="{{ route('gallery.index') }}"
               class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-medium transition-colors inline-flex items-center">
                Jelajahi Semua Galeri
                <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </a>
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="py-16 bg-green-600 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4" data-aos="fade-up">
            Siap untuk Petualangan?
        </h2>
        <p class="text-xl mb-8 text-green-100 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">
            Jangan lewatkan kesempatan untuk merasakan pengalaman tak terlupakan di Gunung Merapi.
            Hubungi kami sekarang dan wujudkan petualangan impian Anda!
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center" data-aos="fade-up" data-aos-delay="400">
            <a href="https://wa.me/6281809769095?text=Halo,%20saya%20tertarik%20dengan%20paket%20wisata%20Jeep%20Merapi%20Adventure"
               target="_blank"
               class="bg-white text-green-600 hover:bg-gray-100 px-8 py-4 rounded-lg font-semibold transition-colors inline-flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                </svg>
                Chat WhatsApp
            </a>
            <a href="{{ route('contact') }}"
               class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-green-600 px-8 py-4 rounded-lg font-semibold transition-colors inline-flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                </svg>
                Kontak Kami
            </a>
        </div>
    </div>
</section>

<!-- Gallery Modal (Full Screen) -->
<div x-show="showModal" class="fixed inset-0 z-50" aria-labelledby="gallery-modal" role="dialog" aria-modal="true">
    <!-- Background backdrop -->
    <div x-show="showModal"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-500/75 transition-opacity"
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
                 class="relative transform overflow-hidden rounded-lg bg-black text-left shadow-xl transition-all sm:my-8 w-full max-w-6xl"
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
                    <div class="flex items-center justify-center relative min-h-[60vh]">
                        <!-- Previous Button -->
                        <button @click="prevImage()"
                                x-show="images.length > 1"
                                class="absolute left-4 top-1/2 -translate-y-1/2 bg-white bg-opacity-20 hover:bg-opacity-30 text-white rounded-full p-3 transition-all z-10">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </button>

                        <!-- Image -->
                        <img :src="images[currentImageIndex]?.src"
                             :alt="images[currentImageIndex]?.alt"
                             class="max-w-full max-h-[70vh] object-contain rounded-lg">

                        <!-- Next Button -->
                        <button @click="nextImage()"
                                x-show="images.length > 1"
                                class="absolute right-4 top-1/2 -translate-y-1/2 bg-white bg-opacity-20 hover:bg-opacity-30 text-white rounded-full p-3 transition-all z-10">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </button>
                    </div>

                    <!-- Image Info -->
                    <div class="mt-4 text-center">
                        <h3 class="text-lg font-medium text-white" x-text="images[currentImageIndex]?.title"></h3>
                        <p class="text-sm text-gray-300 mt-2" x-show="images.length > 1">
                            <span x-text="currentImageIndex + 1"></span> dari <span x-text="images.length"></span> foto
                        </p>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="bg-gray-800 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="button"
                            @click="closeModal()"
                            class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 sm:ml-3 sm:w-auto">
                        Tutup
                    </button>
                    <a :href="'{{ route('gallery.index') }}'"
                       class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-gray-300 ring-inset hover:bg-gray-50 sm:mt-0 sm:w-auto">
                        Lihat Semua Galeri
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    const text = "Rasakan pengalaman tak terlupakan dengan paket wisata Jeep Merapi terpercaya. Nikmati pemandangan spektakuler dan petualangan seru bersama pemandu berpengalaman.";
    const typewriterElement = document.getElementById('typewriter-text');

    if (typewriterElement) {
        typewriterElement.textContent = '';
        let index = 0;

        function typeWriter() {
            if (index < text.length) {
                typewriterElement.textContent += text.charAt(index);
                index++;
                setTimeout(typeWriter, 50);
            } else {
                typewriterElement.innerHTML += '<span class="animate-pulse">|</span>';
            }
        }
        setTimeout(typeWriter, 1000);
    }

    // Kode Swiper Anda (tetap di sini)
    const gallerySwiper = new Swiper('.gallerySwiper', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            640: { slidesPerView: 2, spaceBetween: 20 },
            768: { slidesPerView: 3, spaceBetween: 30 },
            1024: { slidesPerView: 4, spaceBetween: 30 },
        },
    });

    window.addEventListener('load', function() {
        AOS.refresh();
    });
});
</script>
@endpush

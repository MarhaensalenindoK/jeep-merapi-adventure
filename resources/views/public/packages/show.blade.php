@extends('layouts.public.app')

@section('title', $package->name . ' - Jeep Merapi Adventure')
@section('description', $package->description ? Str::limit($package->description, 150) : 'Informasi lengkap tentang paket wisata ' . $package->name . ' dari Jeep Merapi Adventure.')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-green-800 to-green-600 text-white py-20">
    @if($package->image_path && file_exists(public_path('storage/' . $package->image_path)))
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat opacity-40"
         style="background-image: url('{{ asset('storage/' . $package->image_path) }}');">
    </div>
    @else
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat opacity-30"
         style="background-image: url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');">
    </div>
    @endif
    <div class="relative z-10 container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="mb-8" data-aos="fade-up">
                <ol class="flex items-center space-x-2 text-sm">
                    <li><a href="{{ route('home') }}" class="text-green-200 hover:text-white">Beranda</a></li>
                    <li><span class="text-green-300">/</span></li>
                    <li><a href="{{ route('packages.index') }}" class="text-green-200 hover:text-white">Paket Tour</a></li>
                    <li><span class="text-green-300">/</span></li>
                    <li><span class="text-white">{{ $package->name }}</span></li>
                </ol>
            </nav>

            <div class="text-center">
                @if($package->category)
                <div class="mb-4" data-aos="fade-up">
                    <span class="bg-green-500 text-white px-4 py-1 rounded-full text-sm font-medium">
                        {{ $package->category->name }}
                    </span>
                </div>
                @endif

                <h1 class="text-4xl md:text-5xl font-bold mb-6" data-aos="fade-up" data-aos-delay="200">
                    {{ $package->name }}
                </h1>

                @if($package->description)
                <p class="text-xl text-green-100 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="400">
                    {{ Str::limit($package->description, 200) }}
                </p>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Package Details -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <!-- Back Button -->
                    <div class="mb-6" data-aos="fade-right">
                        <a href="{{ route('packages.index') }}"
                           class="inline-flex items-center text-green-600 hover:text-green-700 font-medium transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            Kembali ke Daftar Paket
                        </a>
                    </div>

                    <!-- Package Description -->
                    @if($package->description)
                    <div class="mb-12" data-aos="fade-right">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6">Detail Paket</h2>
                        <div class="ckeditor-content">
                            {!! $package->description !!}
                        </div>
                    </div>
                    @endif

                    <!-- Package Routes / Itinerary -->
                    @if($package->routes)
                    <div class="mb-12" data-aos="fade-right" data-aos-delay="200">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Rute Perjalanan & Itinerary</h3>
                        <div class="ckeditor-content">
                            {!! $package->routes !!}
                        </div>
                    </div>
                    @endif

                    <!-- Package Full Description -->
                    @if($package->full_description)
                    <div class="mb-12" data-aos="fade-right" data-aos-delay="400">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Informasi Lengkap</h3>
                        <div class="ckeditor-content">
                            {!! $package->full_description !!}
                        </div>
                    </div>
                    @endif

                    <!-- Gallery Preview -->
                    @if($package->galleries && $package->galleries->count() > 0)
                    <div class="mb-12" data-aos="fade-right" data-aos-delay="600">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Galeri Foto</h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($package->galleries->take(6) as $gallery)
                                @if(file_exists(public_path('storage/' . $gallery->image_path)))
                                <div class="aspect-square overflow-hidden rounded-lg bg-gray-200 cursor-pointer hover:opacity-75 transition-opacity">
                                    <img src="{{ asset('storage/' . $gallery->image_path) }}"
                                         alt="{{ $gallery->alt_text ?? $gallery->title }}"
                                         class="w-full h-full object-cover">
                                </div>
                                @endif
                            @endforeach
                        </div>
                        @if($package->galleries->count() > 6)
                        <div class="mt-4 text-center">
                            <a href="{{ route('gallery.index', ['package' => $package->slug]) }}"
                               class="text-green-600 hover:text-green-700 font-medium">
                                Lihat Semua Foto ({{ $package->galleries->count() }})
                            </a>
                        </div>
                        @endif
                    </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="sticky top-20">
                        <!-- Booking Card -->
                        <div class="bg-white rounded-lg shadow-lg p-6 mb-8" data-aos="fade-left">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Informasi Booking</h3>

                            <!-- Price -->
                            @if($package->price)
                            <div class="mb-6">
                                <div class="text-3xl font-bold text-green-600 mb-1">
                                    Rp {{ number_format($package->price, 0, ',', '.') }}
                                </div>
                                <div class="text-sm text-gray-600">Per jeep (maks 4-5 orang)</div>
                            </div>
                            @endif

                            <!-- Package Info -->
                            <div class="space-y-3 mb-6">
                                @if($package->duration)
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                    Durasi: {{ $package->duration }}
                                </div>
                                @endif

                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                                    </svg>
                                    Kapasitas: 4-5 orang per jeep
                                </div>

                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                    </svg>
                                    Meeting Point: Base Camp Kaliurang
                                </div>
                            </div>

                            <!-- Booking Buttons -->
                            <div class="space-y-3">
                                <!-- WhatsApp Booking Button -->
                                <a href="https://wa.me/62818909769095?text=Halo,%20saya%20ingin%20booking%20paket%20{{ urlencode($package->name) }}%20untuk%20tanggal%20..."
                                   target="_blank"
                                   class="block w-full bg-green-600 hover:bg-green-700 text-white text-center px-6 py-3 rounded-lg font-bold transition-colors">
                                    <div class="flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                        </svg>
                                        Book via WhatsApp
                                    </div>
                                </a>

                                <!-- Divider -->
                                <div class="relative">
                                    <div class="absolute inset-0 flex items-center">
                                        <div class="w-full border-t border-gray-300"></div>
                                    </div>
                                    <div class="relative flex justify-center text-sm">
                                        <span class="px-2 bg-white text-gray-500">atau</span>
                                    </div>
                                </div>

                                <!-- Tanya Detail Button -->
                                <a href="https://wa.me/62818909769095?text=Halo,%20saya%20ingin%20tanya%20detail%20lebih%20lanjut%20tentang%20paket%20{{ urlencode($package->name) }}"
                                   target="_blank"
                                   class="block w-full bg-white hover:bg-gray-50 text-gray-800 text-center px-6 py-3 rounded-lg font-medium transition-colors border-2 border-gray-300 hover:border-gray-400">
                                    <div class="flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Tanya Detail Lainnya
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Contact Info -->
                        <div class="bg-gray-50 rounded-lg p-6" data-aos="fade-left" data-aos-delay="200">
                            <h4 class="text-lg font-bold text-gray-900 mb-4">Butuh Bantuan?</h4>
                            <div class="space-y-3">
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                    </svg>
                                    +62 818-0976-9095
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                    </svg>
                                    info@jeepmerapiadventure.com
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                    Buka 06:00 - 22:00 WIB
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Packages -->
@if($relatedPackages && $relatedPackages->count() > 0)
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-900 text-center mb-12" data-aos="fade-up">
                Paket Lainnya
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($relatedPackages as $relatedPackage)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300"
                     data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                    @if($relatedPackage->image_path && file_exists(public_path('storage/' . $relatedPackage->image_path)))
                    <div class="aspect-video overflow-hidden">
                        <img src="{{ asset('storage/' . $relatedPackage->image_path) }}"
                             alt="{{ $relatedPackage->name }}"
                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                    </div>
                    @else
                    <div class="aspect-video bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white opacity-50" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    @endif

                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $relatedPackage->name }}</h3>

                        @if($relatedPackage->price)
                        <div class="text-lg font-bold text-green-600 mb-4">
                            Rp {{ number_format($relatedPackage->price, 0, ',', '.') }}
                        </div>
                        @endif

                        <a href="{{ route('packages.show', $relatedPackage->slug) }}"
                           class="w-full bg-green-600 hover:bg-green-700 text-white text-center px-4 py-2 rounded-lg font-medium transition-colors">
                            Lihat Detail
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
@endsection

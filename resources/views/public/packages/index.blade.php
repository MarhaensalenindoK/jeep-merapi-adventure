@extends('layouts.public.app')

@section('title', 'Paket Tour - Jeep Merapi Adventure')
@section('description', 'Jelajahi berbagai paket wisata Jeep Merapi Adventure. Pilih paket Short, Medium, atau Long sesuai dengan waktu dan budget Anda.')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-green-800 to-green-600 text-white py-20">
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat opacity-30"
         style="background-image: url('{{ asset('banner.JPG') }}');">
    </div>
    <div class="relative z-10 container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6" data-aos="fade-up">
                Paket Tour Merapi
            </h1>
            <p class="text-xl text-green-100" data-aos="fade-up" data-aos-delay="200">
                Pilih paket wisata yang sesuai dengan waktu dan preferensi petualangan Anda.
            </p>
        </div>
    </div>
</section>

<!-- Filter Section -->
@if($categories->count() > 0)
<section class="py-8 bg-gray-50 border-b">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('packages.index') }}"
               class="px-6 py-3 rounded-full text-sm font-medium transition-colors {{ !request('category') ? 'bg-green-600 text-white' : 'bg-white text-gray-700 hover:bg-green-50 border border-gray-300' }}">
                <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                </svg>
                Semua Paket
            </a>
            @foreach($categories as $category)
            <a href="{{ route('packages.index', ['category' => $category->slug]) }}"
               class="px-6 py-3 rounded-full text-sm font-medium transition-colors {{ request('category') === $category->slug ? 'bg-green-600 text-white' : 'bg-white text-gray-700 hover:bg-green-50 border border-gray-300' }}">
                {{ $category->name }}
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Packages Grid -->
@if($packages->count() > 0)
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            @if(request('category'))
                @php $selectedCategory = $categories->where('slug', request('category'))->first(); @endphp
                @if($selectedCategory)
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4" data-aos="fade-up">
                        Paket {{ $selectedCategory->name }}
                    </h2>
                    @if($selectedCategory->description)
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                        {{ $selectedCategory->description }}
                    </p>
                    @endif
                </div>
                @endif
            @else
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4" data-aos="fade-up">
                    Pilih Petualangan Anda
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                    Dari petualangan singkat hingga eksplorasi mendalam, kami memiliki paket yang tepat untuk setiap traveler.
                </p>
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($packages as $package)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col h-full"
                     data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                @if($package->galleries->first())
                    <div class="aspect-video overflow-hidden">
                        <img src="{{ asset('storage/' . $package->galleries->first()->image_path) }}"
                             alt="{{ $package->name }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                @else
                    <div class="aspect-video bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white opacity-50" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                @endif

                    <div class="p-6 flex flex-col flex-grow">
                        <!-- Package Category -->
                        @if($package->category)
                        <div class="flex items-center mb-3">
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                {{ $package->category->name }}
                            </span>
                        </div>
                        @endif

                        <!-- Package Name -->
                        <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $package->name }}</h3>

                        <!-- Package Description -->
                        @if($package->description)
                        <p class="text-gray-600 mb-4 line-clamp-3 flex-grow">
                            {{ Str::limit(strip_tags($package->description), 120) }}
                        </p>
                        @endif

                        <!-- Package Info -->
                        <div class="space-y-2 mb-6 mt-auto">
                            @if($package->duration)
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                </svg>
                                Durasi: {{ $package->duration }}
                            </div>
                            @endif

                            @if($package->price)
                            <div class="text-lg font-bold text-green-600">
                                Rp {{ number_format($package->price, 0, ',', '.') }}
                            </div>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-3 mt-auto">
                            <a href="{{ route('packages.show', $package->slug) }}"
                               class="flex-1 bg-green-600 hover:bg-green-700 text-white text-center px-4 py-2 rounded-lg font-medium transition-colors">
                                Lihat Detail
                            </a>
                            <a href="https://wa.me/6281809769095?text=Halo,%20saya%20tertarik%20dengan%20paket%20{{ urlencode($package->name) }}"
                               target="_blank"
                               class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-lg font-medium transition-colors flex items-center justify-center">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($packages->hasPages())
            <div class="mt-12">
                <!-- Pagination Links -->
                <div>
                    {{ $packages->appends(request()->query())->links('vendor.pagination.custom-theme') }}
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@else
<!-- Empty State -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto text-center">
            <div class="text-gray-400 mb-6">
                <svg class="w-20 h-20 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">
                Belum Ada Paket Tersedia
            </h2>
            <p class="text-gray-600 mb-8">
                {{ request('category') ? 'Belum ada paket untuk kategori ini.' : 'Belum ada paket wisata tersedia.' }}
                Segera akan ada paket petualangan yang menakjubkan!
            </p>
            <a href="{{ route('home') }}"
               class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="py-16 bg-green-600">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-white mb-6" data-aos="fade-up">
                Tidak Menemukan Paket yang Cocok?
            </h2>
            <p class="text-xl text-green-100 mb-8" data-aos="fade-up" data-aos-delay="200">
                Kami juga menyediakan paket custom sesuai kebutuhan dan budget Anda. Hubungi kami untuk konsultasi gratis!
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center" data-aos="fade-up" data-aos-delay="400">
                <a href="{{ route('contact') }}"
                   class="bg-white text-green-600 hover:bg-gray-100 px-8 py-3 rounded-lg font-bold transition-colors">
                    Konsultasi Gratis
                </a>
                <a href="https://wa.me/6281809769095?text=Halo,%20saya%20ingin%20membuat%20paket%20custom%20Jeep%20Merapi%20Adventure"
                   target="_blank"
                   class="border-2 border-white text-white hover:bg-white hover:text-green-600 px-8 py-3 rounded-lg font-bold transition-colors">
                    Chat WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

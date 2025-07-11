@extends('layouts.public.app')

@section('title', 'Tentang Kami - Jeep Merapi Adventure')
@section('description', 'Kenali lebih dekat Jeep Merapi Adventure. Kami berkomitmen memberikan pengalaman wisata Merapi terbaik dengan standar keamanan tinggi dan pelayanan profesional.')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-green-800 to-green-600 text-white py-20">
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat opacity-30"
         style="background-image: url('{{ asset('banner.JPG') }}');">
    </div>
    <div class="relative z-10 container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6" data-aos="fade-up">
                Tentang Kami
            </h1>
            <p class="text-xl text-green-100" data-aos="fade-up" data-aos-delay="200">
                Mengenal lebih dekat Jeep Merapi Adventure dan komitmen kami untuk memberikan pengalaman wisata terbaik.
            </p>
        </div>
    </div>
</section>

<!-- Tentang Kami -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-900 mb-6 text-center" data-aos="fade-up">Tentang Kami</h2>
            <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                <p class="text-gray-600 mb-4 text-lg leading-relaxed">
                    Jeep Merapi Adventure didirikan dengan misi sederhana: memberikan pengalaman wisata Gunung Merapi yang tak terlupakan dengan standar keamanan tertinggi. Sejak tahun 2015, kami telah melayani ribuan wisatawan dari berbagai negara.
                </p>
                <p class="text-gray-600 mb-4 text-lg leading-relaxed">
                    Dengan tim pemandu berpengalaman dan armada jeep yang terawat, kami berkomitmen menjadi partner terpercaya dalam setiap petualangan Anda menjelajahi keindahan Gunung Merapi.
                </p>
                <p class="text-gray-600 text-lg leading-relaxed">
                    Keamanan wisatawan adalah prioritas utama kami. Setiap perjalanan dilaksanakan dengan protokol keselamatan yang ketat dan dipimpin oleh pemandu lokal yang menguasai medan dan kondisi gunung.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Key Features -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-2" data-aos="fade-up">
                Mengapa Memilih Kami?
            </h2>
            <p class="text-center text-gray-600" data-aos="fade-up" data-aos-delay="100">
                Komitmen kami untuk memberikan pengalaman terbaik bagi petualangan Anda.
            </p>
        </div>

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
</section>

<!-- CTA Section -->
<section class="py-16 bg-green-600">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-white mb-6" data-aos="fade-up">
                Siap Memulai Petualangan?
            </h2>
            <p class="text-xl text-green-100 mb-8" data-aos="fade-up" data-aos-delay="200">
                Bergabunglah dengan ribuan wisatawan yang telah merasakan pengalaman tak terlupakan bersama kami.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center" data-aos="fade-up" data-aos-delay="400">
                <a href="{{ route('packages.index') }}"
                   class="bg-white text-green-600 hover:bg-gray-100 px-8 py-3 rounded-lg font-bold transition-colors">
                    Lihat Paket Wisata
                </a>
                <a href="{{ route('contact') }}"
                   class="border-2 border-white text-white hover:bg-white hover:text-green-600 px-8 py-3 rounded-lg font-bold transition-colors">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

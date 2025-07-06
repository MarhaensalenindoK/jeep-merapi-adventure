@extends('layouts.public.app')

@section('title', 'Tentang Kami - Jeep Merapi Adventure')
@section('description', 'Kenali lebih dekat Jeep Merapi Adventure. Kami berkomitmen memberikan pengalaman wisata Merapi terbaik dengan standar keamanan tinggi dan pelayanan profesional.')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-green-800 to-green-600 text-white py-20">
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat opacity-30"
         style="background-image: url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');">
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

<!-- Company Story -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Perjalanan Kami</h2>
                    <p class="text-gray-600 mb-4">
                        Jeep Merapi Adventure didirikan dengan misi sederhana: memberikan pengalaman wisata Gunung Merapi yang tak terlupakan dengan standar keamanan tertinggi. Sejak tahun 2015, kami telah melayani ribuan wisatawan dari berbagai negara.
                    </p>
                    <p class="text-gray-600 mb-4">
                        Dengan tim pemandu berpengalaman dan armada jeep yang terawat, kami berkomitmen menjadi partner terpercaya dalam setiap petualangan Anda menjelajahi keindahan Gunung Merapi.
                    </p>
                    <p class="text-gray-600">
                        Keamanan wisatawan adalah prioritas utama kami. Setiap perjalanan dilaksanakan dengan protokol keselamatan yang ketat dan dipimpin oleh pemandu lokal yang menguasai medan dan kondisi gunung.
                    </p>
                </div>
                <div data-aos="fade-left">
                    <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                         alt="Tim Jeep Merapi Adventure"
                         class="rounded-lg shadow-lg">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-6" data-aos="fade-up">Visi & Misi</h2>
        </div>

        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white p-8 rounded-lg shadow-md" data-aos="fade-up" data-aos-delay="100">
                <div class="text-green-600 mb-4">
                    <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Visi</h3>
                <p class="text-gray-600">
                    Menjadi penyedia layanan wisata Gunung Merapi terdepan yang memberikan pengalaman petualangan aman, berkesan, dan berkelanjutan bagi setiap wisatawan.
                </p>
            </div>

            <div class="bg-white p-8 rounded-lg shadow-md" data-aos="fade-up" data-aos-delay="200">
                <div class="text-green-600 mb-4">
                    <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Misi</h3>
                <p class="text-gray-600">
                    Memberikan layanan wisata Merapi yang profesional, aman, dan berkualitas tinggi sambil menjaga kelestarian alam dan memberdayakan masyarakat lokal.
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

<!-- Team Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-6" data-aos="fade-up">Tim Profesional</h2>
            <p class="text-xl text-gray-600" data-aos="fade-up" data-aos-delay="200">
                Dipimpin oleh para ahli yang menguasai medan dan berpengalaman puluhan tahun.
            </p>
        </div>

        <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-lg shadow-md overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                     alt="Budi Santoso"
                     class="w-full h-64 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Budi Santoso</h3>
                    <p class="text-green-600 font-medium mb-3">Founder & Head Guide</p>
                    <p class="text-gray-600">Pendiri dengan pengalaman 15 tahun sebagai pemandu Merapi. Menguasai seluruh rute dan kondisi gunung.</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                     alt="Andi Wijaya"
                     class="w-full h-64 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Andi Wijaya</h3>
                    <p class="text-green-600 font-medium mb-3">Operations Manager</p>
                    <p class="text-gray-600">Bertanggung jawab atas operasional harian dan memastikan standar pelayanan terbaik untuk setiap wisatawan.</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden" data-aos="fade-up" data-aos-delay="300">
                <img src="https://images.unsplash.com/photo-1494790108755-2616b612b977?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                     alt="Sari Lestari"
                     class="w-full h-64 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Sari Lestari</h3>
                    <p class="text-green-600 font-medium mb-3">Customer Service</p>
                    <p class="text-gray-600">Siap membantu perencanaan perjalanan Anda dengan informasi lengkap dan pelayanan yang ramah.</p>
                </div>
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

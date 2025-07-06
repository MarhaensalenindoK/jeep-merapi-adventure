@extends('layouts.public.app')

@section('title', 'Blog - Jeep Merapi Adventure')
@section('description', 'Baca artikel informatif seputar wisata Merapi, tips traveling, dan cerita petualangan dari Jeep Merapi Adventure.')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-orange-800 to-orange-600 text-white py-20">
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat opacity-30"
         style="background-image: url('{{ asset('banner.JPG') }}');">
    </div>
    <div class="relative z-10 container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6" data-aos="fade-up">
                Blog & Artikel
            </h1>
            <p class="text-xl text-orange-100" data-aos="fade-up" data-aos-delay="200">
                Baca artikel informatif seputar wisata Merapi, tips traveling, dan cerita petualangan.
            </p>
        </div>
    </div>
</section>

<!-- Search Section -->
<section class="py-8 bg-gray-50 border-b">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto">
            <form action="{{ route('blog.index') }}" method="GET" class="flex gap-4">
                <div class="flex-1">
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari artikel..."
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                </div>
                <button type="submit"
                        class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </form>
            @if(request('search'))
            <div class="mt-4 text-center">
                <span class="text-gray-600">Hasil pencarian untuk: <strong>"{{ request('search') }}"</strong></span>
                <a href="{{ route('blog.index') }}" class="ml-2 text-orange-600 hover:text-orange-700">Hapus Filter</a>
            </div>
            @endif
        </div>
    </div>
</section>

<!-- Blog Posts -->
@if($posts->count() > 0)
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            @if(!request('search'))
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4" data-aos="fade-up">
                    Artikel Terbaru
                </h2>
                <p class="text-xl text-gray-600" data-aos="fade-up" data-aos-delay="200">
                    Dapatkan informasi terbaru tentang wisata Merapi dan tips petualangan.
                </p>
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($posts as $post)
                <article class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300"
                         data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                    @if($post->featured_image && file_exists(public_path('storage/' . $post->featured_image)))
                    <div class="aspect-video overflow-hidden">
                        <img src="{{ asset('storage/' . $post->featured_image) }}"
                             alt="{{ $post->title }}"
                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                    </div>
                    @else
                    <div class="aspect-video bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white opacity-50" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    @endif

                    <div class="p-6">
                        <!-- Post Meta -->
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                            </svg>
                            {{ $post->updated_at ? $post->updated_at->format('d M Y') : '-' }}
                            @if($post->author)
                            <span class="mx-2">•</span>
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                            {{ $post->author->name }}
                            @endif
                        </div>

                        <!-- Post Title -->
                        <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                            <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-orange-600 transition-colors">
                                {{ $post->title }}
                            </a>
                        </h3>

                        <!-- Post Excerpt -->
                        @if($post->excerpt)
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ $post->excerpt }}
                        </p>
                        @else
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ Str::limit(strip_tags($post->body), 120) }}
                        </p>
                        @endif

                        <!-- Read More -->
                        <div class="flex items-center justify-between">
                            <a href="{{ route('blog.show', $post->slug) }}"
                               class="text-orange-600 hover:text-orange-700 font-medium inline-flex items-center">
                                Baca Selengkapnya
                                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </a>

                            <!-- Reading Time -->
                            <span class="text-sm text-gray-500">
                                {{ ceil(str_word_count(strip_tags($post->body)) / 200) }} min baca
                            </span>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($posts->hasPages())
            <div class="mt-12">
                <!-- Pagination Links -->
                <div>
                    {{ $posts->appends(request()->query())->links() }}
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
                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">
                {{ request('search') ? 'Artikel Tidak Ditemukan' : 'Belum Ada Artikel' }}
            </h2>
            <p class="text-gray-600 mb-8">
                {{ request('search')
                    ? 'Tidak ada artikel yang sesuai dengan pencarian Anda. Coba gunakan kata kunci yang berbeda.'
                    : 'Belum ada artikel yang dipublikasikan. Segera akan ada artikel-artikel menarik seputar wisata Merapi!'
                }}
            </p>
            @if(request('search'))
                <a href="{{ route('blog.index') }}"
                   class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-lg font-medium transition-colors mr-4">
                    Lihat Semua Artikel
                </a>
            @endif
            <a href="{{ route('home') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</section>
@endif

<!-- Newsletter CTA -->
<section class="py-16 bg-orange-600">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-white mb-6" data-aos="fade-up">
                Jangan Lewatkan Update Terbaru
            </h2>
            <p class="text-xl text-orange-100 mb-8" data-aos="fade-up" data-aos-delay="200">
                Dapatkan informasi terbaru tentang paket wisata, tips traveling, dan penawaran khusus.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center" data-aos="fade-up" data-aos-delay="400">
                <a href="{{ route('packages.index') }}"
                   class="bg-white text-orange-600 hover:bg-gray-100 px-8 py-3 rounded-lg font-bold transition-colors">
                    Lihat Paket Wisata
                </a>
                <a href="https://wa.me/6281809769095?text=Halo,%20saya%20ingin%20mendapatkan%20info%20update%20terbaru%20dari%20Jeep%20Merapi%20Adventure"
                   target="_blank"
                   class="border-2 border-white text-white hover:bg-white hover:text-orange-600 px-8 py-3 rounded-lg font-bold transition-colors">
                    Subscribe via WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

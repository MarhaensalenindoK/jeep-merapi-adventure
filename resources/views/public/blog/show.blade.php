@extends('layouts.public.app')

@section('title', $post->meta_title ?: $post->title . ' - Jeep Merapi Adventure')
@section('description', $post->meta_description ?: $post->excerpt)

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-orange-600 to-red-700 py-20">
    <div class="absolute inset-0 bg-black opacity-40"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center text-white">
            <!-- Breadcrumb -->
            <nav class="mb-8">
                <ol class="flex items-center justify-center space-x-2 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-orange-200 transition-colors">Beranda</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li><a href="{{ route('blog.index') }}" class="hover:text-orange-200 transition-colors">Blog</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li class="text-orange-200">{{ $post->title }}</li>
                </ol>
            </nav>

            <h1 class="text-4xl md:text-5xl font-bold mb-6">{{ $post->title }}</h1>
            <p class="text-xl text-orange-100 mb-8">{{ $post->excerpt }}</p>

            <!-- Article Meta -->
            <div class="flex flex-wrap items-center justify-center gap-6 text-orange-100">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                    </svg>
                    {{ $post->updated_at ? $post->updated_at->format('d F Y') : '-' }}
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    {{ number_format(str_word_count(strip_tags($post->body)) / 200) }} menit baca
                </div>
                @if($post->author)
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                    {{ $post->author->name }}
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Article Content -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <!-- Featured Image -->
                    @if($post->featured_image)
                    <div class="mb-8">
                        <img src="{{ asset('storage/' . $post->featured_image) }}"
                             alt="{{ $post->title }}"
                             class="w-full h-64 md:h-80 object-cover rounded-lg shadow-lg">
                    </div>
                    @endif

                    <!-- Article Body -->
                    <div class="ckeditor-content">
                        {!! $post->body !!}
                    </div>

                    <!-- Tags -->
                    @if($post->tags)
                    <div class="mt-8 pt-8 border-t border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Tags:</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(',', $post->tags) as $tag)
                            <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm font-medium">
                                {{ trim($tag) }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Share Buttons -->
                    <div class="mt-8 pt-8 border-t border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Bagikan Artikel:</h3>
                        <div class="flex flex-wrap gap-4">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                               target="_blank"
                               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                                Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($post->title) }}"
                               target="_blank"
                               class="bg-sky-500 hover:bg-sky-600 text-white px-4 py-2 rounded-lg flex items-center transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                                Twitter
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($post->title . ' - ' . request()->fullUrl()) }}"
                               target="_blank"
                               class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                </svg>
                                WhatsApp
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Navigation -->
                    <div class="bg-gray-50 p-6 rounded-lg mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Navigasi</h3>
                        <div class="space-y-3">
                            <a href="{{ route('blog.index') }}"
                               class="flex items-center text-gray-600 hover:text-orange-600 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                                </svg>
                                Kembali ke Blog
                            </a>
                            <a href="{{ route('packages.index') }}"
                               class="flex items-center text-gray-600 hover:text-orange-600 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                                </svg>
                                Lihat Paket Tour
                            </a>
                            <a href="{{ route('contact') }}"
                               class="flex items-center text-gray-600 hover:text-orange-600 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                </svg>
                                Hubungi Kami
                            </a>
                        </div>
                    </div>

                    <!-- Quick Contact -->
                    <div class="bg-orange-50 p-6 rounded-lg mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Butuh Bantuan?</h3>
                        <p class="text-gray-600 mb-4">Tim kami siap membantu merencanakan petualangan Merapi Anda!</p>
                        <div class="space-y-3">
                            <a href="https://wa.me/6281809769095"
                               class="flex items-center text-green-600 hover:text-green-700 font-medium">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                </svg>
                                WhatsApp
                            </a>
                            <a href="tel:+6281809769095"
                               class="flex items-center text-orange-600 hover:text-orange-700 font-medium">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                </svg>
                                6281809769095
                            </a>
                        </div>
                    </div>

                    <!-- Popular Articles -->
                    @if($relatedPosts->count() > 0)
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Artikel Terkait</h3>
                        <div class="space-y-4">
                            @foreach($relatedPosts as $relatedPost)
                            <article class="border-b border-gray-200 pb-4 last:border-b-0 last:pb-0">
                                <a href="{{ route('blog.show', $relatedPost->slug) }}"
                                   class="block group">
                                    <h4 class="font-medium text-gray-900 group-hover:text-orange-600 transition-colors mb-2 line-clamp-2">
                                        {{ $relatedPost->title }}
                                    </h4>
                                    <p class="text-sm text-gray-600 mb-2 line-clamp-2">
                                        {{ $relatedPost->excerpt }}
                                    </p>
                                    <time class="text-xs text-gray-500">
                                        {{ $relatedPost->updated_at ? $relatedPost->updated_at->format('d M Y') : '-' }}
                                    </time>
                                </a>
                            </article>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-r from-orange-600 to-red-600">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
            Siap untuk Petualangan Merapi?
        </h2>
        <p class="text-xl text-orange-100 mb-8 max-w-2xl mx-auto">
            Bergabunglah dengan ribuan petualang lainnya yang telah merasakan pengalaman tak terlupakan di Gunung Merapi.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('packages.index') }}"
               class="bg-white text-orange-600 hover:bg-orange-50 px-8 py-4 rounded-lg font-bold text-lg transition-colors">
                Lihat Paket Tour
            </a>
            <a href="{{ route('contact') }}"
               class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-orange-600 px-8 py-4 rounded-lg font-bold text-lg transition-colors">
                Konsultasi Gratis
            </a>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
/* CKEditor Content Styling */
.ckeditor-content {
    font-size: 1.125rem;
    line-height: 1.75;
    color: #374151;
    max-width: none;
}

.ckeditor-content p {
    margin-bottom: 1.5rem;
    line-height: 1.75;
}

.ckeditor-content h1,
.ckeditor-content h2,
.ckeditor-content h3,
.ckeditor-content h4,
.ckeditor-content h5,
.ckeditor-content h6 {
    font-weight: bold;
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: #1f2937;
}

.ckeditor-content h1 {
    font-size: 2rem;
    line-height: 1.25;
}

.ckeditor-content h2 {
    font-size: 1.75rem;
    line-height: 1.25;
}

.ckeditor-content h3 {
    font-size: 1.5rem;
    line-height: 1.375;
}

.ckeditor-content h4 {
    font-size: 1.25rem;
    line-height: 1.5;
}

.ckeditor-content h5 {
    font-size: 1.125rem;
    line-height: 1.5;
}

.ckeditor-content h6 {
    font-size: 1rem;
    line-height: 1.5;
}

.ckeditor-content strong,
.ckeditor-content b {
    font-weight: 700;
    color: #1f2937;
}

.ckeditor-content em,
.ckeditor-content i {
    font-style: italic;
}

.ckeditor-content u {
    text-decoration: underline;
}

.ckeditor-content ul,
.ckeditor-content ol {
    margin-bottom: 1.5rem;
    padding-left: 1.5rem;
}

.ckeditor-content ul {
    list-style-type: disc;
}

.ckeditor-content ol {
    list-style-type: decimal;
}

.ckeditor-content li {
    margin-bottom: 0.5rem;
    line-height: 1.75;
}

.ckeditor-content blockquote {
    border-left: 4px solid #ea580c;
    padding-left: 1rem;
    margin: 1.5rem 0;
    font-style: italic;
    color: #6b7280;
    background-color: #f9fafb;
    padding: 1rem;
    border-radius: 0.375rem;
}

.ckeditor-content a {
    color: #ea580c;
    text-decoration: underline;
    font-weight: 500;
}

.ckeditor-content a:hover {
    color: #c2410c;
    text-decoration: none;
}

.ckeditor-content img {
    max-width: 100%;
    height: auto;
    border-radius: 0.5rem;
    margin: 1.5rem 0;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.ckeditor-content figure {
    margin: 1.5rem 0;
    text-align: center;
}

.ckeditor-content figcaption {
    margin-top: 0.5rem;
    font-size: 0.875rem;
    color: #6b7280;
    font-style: italic;
}

.ckeditor-content table {
    width: 100%;
    border-collapse: collapse;
    margin: 1.5rem 0;
    background-color: white;
    border-radius: 0.5rem;
    overflow: hidden;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
}

.ckeditor-content th,
.ckeditor-content td {
    padding: 0.75rem;
    text-align: left;
    border-bottom: 1px solid #e5e7eb;
}

.ckeditor-content th {
    background-color: #f9fafb;
    font-weight: 600;
    color: #374151;
}

.ckeditor-content tr:hover {
    background-color: #f9fafb;
}

.ckeditor-content code {
    background-color: #f3f4f6;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
    font-size: 0.875rem;
    color: #dc2626;
}

.ckeditor-content pre {
    background-color: #1f2937;
    color: #f9fafb;
    padding: 1rem;
    border-radius: 0.5rem;
    overflow-x: auto;
    margin: 1.5rem 0;
}

.ckeditor-content pre code {
    background-color: transparent;
    padding: 0;
    color: inherit;
    font-size: 0.875rem;
}

.ckeditor-content hr {
    border: none;
    border-top: 2px solid #e5e7eb;
    margin: 2rem 0;
}

/* Text alignment classes that CKEditor might add */
.ckeditor-content .text-left {
    text-align: left;
}

.ckeditor-content .text-center {
    text-align: center;
}

.ckeditor-content .text-right {
    text-align: right;
}

.ckeditor-content .text-justify {
    text-align: justify;
}

/* Responsive improvements */
@media (max-width: 640px) {
    .ckeditor-content {
        font-size: 1rem;
        line-height: 1.625;
    }

    .ckeditor-content h1 {
        font-size: 1.75rem;
    }

    .ckeditor-content h2 {
        font-size: 1.5rem;
    }

    .ckeditor-content h3 {
        font-size: 1.25rem;
    }
}
</style>
@endpush

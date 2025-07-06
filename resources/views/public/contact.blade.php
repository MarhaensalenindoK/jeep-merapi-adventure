@extends('layouts.public.app')

@section('title', 'Kontak - Jeep Merapi Adventure')
@section('description', 'Hubungi Jeep Merapi Adventure untuk informasi lebih lanjut tentang paket wisata Merapi. Kami siap membantu Anda merencanakan petualangan tak terlupakan.')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-blue-800 to-blue-600 text-white py-20">
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat opacity-30"
         style="background-image: url('https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2072&q=80');">
    </div>
    <div class="relative z-10 container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6" data-aos="fade-up">
                Hubungi Kami
            </h1>
            <p class="text-xl text-blue-100" data-aos="fade-up" data-aos-delay="200">
                Kami siap membantu Anda merencanakan petualangan tak terlupakan di Gunung Merapi.
            </p>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div data-aos="fade-right">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Kirim Pesan</h2>
                    <p class="text-gray-600 mb-8">
                        Silakan isi formulir di bawah ini untuk mengirimkan pertanyaan atau permintaan informasi. Tim kami akan merespon secepat mungkin.
                    </p>

                    <form class="space-y-6" id="contactForm" onsubmit="sendToWhatsApp(event)">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" id="name" name="name" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                                <input type="tel" id="phone" name="phone" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" id="email" name="email" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                        </div>

                        <div>
                            <label for="package" class="block text-sm font-medium text-gray-700 mb-2">Paket yang Diminati</label>
                            <select id="package" name="package"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                                <option value="">Pilih Paket (Opsional)</option>
                                @foreach($packages as $package)
                                <option value="{{ $package->name }}">
                                    {{ $package->name }}
                                    @if($package->price)
                                        - Rp {{ number_format($package->price, 0, ',', '.') }}
                                    @endif
                                </option>
                                @endforeach
                                <option value="Paket Custom">Paket Custom - Sesuai Kebutuhan</option>
                            </select>
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Pesan</label>
                            <textarea id="message" name="message" rows="5" required
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                                      placeholder="Ceritakan kepada kami tentang rencana perjalanan Anda..."></textarea>
                        </div>

                        <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-bold transition-colors flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                            </svg>
                            Kirim via WhatsApp
                        </button>
                    </form>
                </div>

                <!-- Contact Info -->
                <div data-aos="fade-left">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Informasi Kontak</h2>

                    <!-- Contact Cards -->
                    <div class="space-y-6">
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <div class="flex items-start space-x-4">
                                <div class="bg-blue-100 rounded-full p-3">
                                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Telepon & WhatsApp</h3>
                                    <p class="text-gray-600 mb-2">+6281809769095</p>
                                    <p class="text-sm text-gray-500">Tersedia 24/7 untuk informasi dan booking</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-6 rounded-lg">
                            <div class="flex items-start space-x-4">
                                <div class="bg-blue-100 rounded-full p-3">
                                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Email</h3>
                                    <p class="text-gray-600 mb-2">elissuraningsih@gmail.com</p>
                                    <p class="text-sm text-gray-500">Respon dalam 24 jam</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-6 rounded-lg">
                            <div class="flex items-start space-x-4">
                                <div class="bg-blue-100 rounded-full p-3">
                                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Alamat</h3>
                                    <p class="text-gray-600 mb-2">Sidorejo Umbulharjo Cangkringan Sleman Yogyakarta</p>
                                    <p class="text-sm text-gray-500">Base camp dan titik kumpul</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-6 rounded-lg">
                            <div class="flex items-start space-x-4">
                                <div class="bg-blue-100 rounded-full p-3">
                                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Jam Operasional</h3>
                                    <div class="text-gray-600 space-y-1">
                                        <p>Senin - Minggu: 04:00 - 18:00 WIB</p>
                                        <p class="text-sm text-gray-500">Untuk keadaan darurat, hubungi WhatsApp 24/7</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="mt-8 space-y-4">
                        <a href="https://wa.me/6281809769095?text=Halo,%20saya%20tertarik%20dengan%20paket%20wisata%20Jeep%20Merapi%20Adventure"
                           target="_blank"
                           class="w-full bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-bold transition-colors inline-flex items-center justify-center">
                            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                            </svg>
                            Chat WhatsApp Sekarang
                        </a>

                        <a href="tel:+6281809769095"
                           class="w-full bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-bold transition-colors inline-flex items-center justify-center">
                            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                            Telepon Langsung
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-6" data-aos="fade-up">Lokasi Base Camp</h2>
            <p class="text-xl text-gray-600" data-aos="fade-up" data-aos-delay="200">
                Kunjungi base camp kami untuk informasi lebih lanjut atau meeting point sebelum perjalanan.
            </p>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden" data-aos="fade-up" data-aos-delay="400">
            <!-- Google Maps Embed -->
            <div class="aspect-video">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31636.302836024806!2d110.4058499080751!3d-7.625156662975694!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a6732ce979e11%3A0x84c0ba34df884e99!2sJeep%20Merapi%20Adventure%20%7C%7C%20Jeep%20Merapi%20Kaliurang%20%7C%7C%20Lava%20Tour%20Merapi!5e0!3m2!1sid!2sid!4v1751182524832!5m2!1sid!2sid"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="bg-blue-100 rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-1">Alamat Lengkap</h3>
                        <p class="text-sm text-gray-600">Sidorejo Umbulharjo Cangkringan Sleman Yogyakarta</p>
                    </div>

                    <div class="text-center">
                        <div class="bg-blue-100 rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.236 4.53L8.093 10.5a.75.75 0 00-1.186.918l1.736 2.237a.75.75 0 001.199.1l3.75-5.25z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-1">Fasilitas</h3>
                        <p class="text-sm text-gray-600">Parkir, Toilet, Mushola, Warung makan</p>
                    </div>

                    <div class="text-center">
                        <div class="bg-blue-100 rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                                <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1V8a1 1 0 00-1-1h-3z"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-1">Akses</h3>
                        <p class="text-sm text-gray-600">Lokasi strategis di kawasan wisata Merapi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-blue-600">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-white mb-6" data-aos="fade-up">
                Siap Memulai Petualangan?
            </h2>
            <p class="text-xl text-blue-100 mb-8" data-aos="fade-up" data-aos-delay="200">
                Jangan ragu untuk menghubungi kami. Tim profesional kami siap membantu merencanakan perjalanan impian Anda.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center" data-aos="fade-up" data-aos-delay="400">
                <a href="{{ route('packages.index') }}"
                   class="bg-white text-blue-600 hover:bg-gray-100 px-8 py-3 rounded-lg font-bold transition-colors">
                    Lihat Paket Wisata
                </a>
                <a href="https://wa.me/6281809769095?text=Halo,%20saya%20tertarik%20dengan%20paket%20wisata%20Jeep%20Merapi%20Adventure"
                   target="_blank"
                   class="border-2 border-white text-white hover:bg-white hover:text-blue-600 px-8 py-3 rounded-lg font-bold transition-colors">
                    Chat WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Success Modal -->
<div id="successModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Background backdrop -->
    <div class="fixed inset-0 bg-gray-900/75 transition-opacity"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center">
            <!-- Dialog panel -->
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                            <!-- WhatsApp Icon -->
                            <svg class="h-6 w-6 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <h3 class="text-lg font-semibold leading-6 text-gray-900" id="modal-title">
                                Pesan Siap Dikirim!
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Pesan Anda telah diformat dan WhatsApp akan terbuka di tab baru. Silakan tekan tombol "Send" di WhatsApp untuk mengirim pesan kepada tim kami.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 gap-3">
                    <button type="button" id="sendAgainBtn"
                            class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 sm:w-auto">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                        </svg>
                        Kirim Ulang
                    </button>
                    <button type="button" id="closeModalBtn"
                            class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Global variable untuk menyimpan URL WhatsApp
let currentWhatsAppURL = '';

function sendToWhatsApp(event) {
    event.preventDefault();

    // Ambil data dari form
    const name = document.getElementById('name').value;
    const phone = document.getElementById('phone').value;
    const email = document.getElementById('email').value;
    const package = document.getElementById('package').value;
    const message = document.getElementById('message').value;

    // Validasi form
    if (!name || !phone || !email || !message) {
        alert('Mohon lengkapi semua field yang wajib diisi.');
        return;
    }

    // Format pesan WhatsApp
    let whatsappMessage = `Halo Jeep Merapi Adventure! 👋\n\n`;
    whatsappMessage += `Saya ingin bertanya tentang paket wisata. Berikut detail informasi saya:\n\n`;
    whatsappMessage += `📝 *Data Kontak:*\n`;
    whatsappMessage += `• Nama: ${name}\n`;
    whatsappMessage += `• Telepon: ${phone}\n`;
    whatsappMessage += `• Email: ${email}\n\n`;

    if (package) {
        whatsappMessage += `🎯 *Paket yang Diminati:* ${package}\n\n`;
    }

    whatsappMessage += `💬 *Pesan:*\n${message}\n\n`;
    whatsappMessage += `Mohon informasi lebih lanjut tentang paket wisata dan ketersediaan jadwal. Terima kasih! 🙏`;

    // Encode pesan untuk URL
    const encodedMessage = encodeURIComponent(whatsappMessage);

    // Nomor WhatsApp (tanpa +)
    const whatsappNumber = '6281809769095';

    // Buat URL WhatsApp
    currentWhatsAppURL = `https://wa.me/${whatsappNumber}?text=${encodedMessage}`;

    // Buka WhatsApp di tab baru
    window.open(currentWhatsAppURL, '_blank');

    // Tampilkan modal
    showModal();
}

function showModal() {
    document.getElementById('successModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function hideModal() {
    document.getElementById('successModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function sendAgain() {
    // Kirim ulang ke WhatsApp tanpa menutup modal
    if (currentWhatsAppURL) {
        window.open(currentWhatsAppURL, '_blank');
    }
    // Modal tetap terbuka, tidak memanggil hideModal()
}

// Event listeners untuk modal
document.addEventListener('DOMContentLoaded', function() {
    // Tombol Tutup
    document.getElementById('closeModalBtn').addEventListener('click', hideModal);

    // Tombol Kirim Ulang
    document.getElementById('sendAgainBtn').addEventListener('click', sendAgain);

    // Tutup modal dengan ESC key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            hideModal();
        }
    });

    // Tutup modal dengan klik background
    document.getElementById('successModal').addEventListener('click', function(event) {
        if (event.target === this) {
            hideModal();
        }
    });
});
</script>
@endpush

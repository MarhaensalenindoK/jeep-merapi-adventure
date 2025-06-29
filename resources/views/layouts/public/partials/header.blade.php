<!-- Header Navigation -->
<header class="bg-white shadow-md sticky top-0 z-40">
    <nav class="container mx-auto px-4" x-data="{ mobileOpen: false }">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center">
                    <div class="flex items-center space-x-3">
                        <!-- Logo Icon -->
                        <div class="w-10 h-10 bg-gradient-to-br from-green-600 to-green-700 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"/>
                            </svg>
                        </div>
                        <!-- Logo Text -->
                        <div class="hidden sm:block">
                            <div class="font-bold text-lg text-gray-900">Jeep Merapi</div>
                            <div class="text-xs text-green-600 -mt-1">Adventure</div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-8">
                    <a href="{{ route('home') }}"
                       class="text-gray-900 hover:text-green-600 px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('home') ? 'text-green-600 font-semibold' : '' }}">
                        Beranda
                    </a>
                    <a href="{{ route('about') }}"
                       class="text-gray-700 hover:text-green-600 px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('about') ? 'text-green-600 font-semibold' : '' }}">
                        Tentang Kami
                    </a>
                    <a href="{{ route('packages.index') }}"
                       class="text-gray-700 hover:text-green-600 px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('packages.*') ? 'text-green-600 font-semibold' : '' }}">
                        Paket Tour
                    </a>
                    <a href="{{ route('gallery.index') }}"
                       class="text-gray-700 hover:text-green-600 px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('gallery.*') ? 'text-green-600 font-semibold' : '' }}">
                        Galeri
                    </a>
                    <a href="{{ route('blog.index') }}"
                       class="text-gray-700 hover:text-green-600 px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('blog.*') ? 'text-green-600 font-semibold' : '' }}">
                        Blog
                    </a>
                    <a href="{{ route('contact') }}"
                       class="text-gray-700 hover:text-green-600 px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('contact') ? 'text-green-600 font-semibold' : '' }}">
                        Kontak
                    </a>
                </div>
            </div>

            <!-- CTA Button -->
            <div class="hidden md:block">
                <a href="https://wa.me/62818909769095?text=Halo,%20saya%20tertarik%20dengan%20paket%20wisata%20Jeep%20Merapi%20Adventure"
                   target="_blank"
                   class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors inline-flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                    </svg>
                    Hubungi Kami
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button @click="mobileOpen = !mobileOpen"
                        class="text-gray-700 hover:text-green-600 focus:outline-none focus:text-green-600 p-2">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path :class="{'hidden': mobileOpen, 'inline-flex': !mobileOpen }"
                              class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !mobileOpen, 'inline-flex': mobileOpen }"
                              class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div :class="{'block': mobileOpen, 'hidden': !mobileOpen}" class="hidden md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 border-t border-gray-200">
                <a href="{{ route('home') }}"
                   class="text-gray-900 block px-3 py-2 text-base font-medium {{ request()->routeIs('home') ? 'text-green-600 bg-green-50' : 'hover:text-green-600 hover:bg-gray-50' }}">
                    Beranda
                </a>
                <a href="{{ route('about') }}"
                   class="text-gray-700 block px-3 py-2 text-base font-medium {{ request()->routeIs('about') ? 'text-green-600 bg-green-50' : 'hover:text-green-600 hover:bg-gray-50' }}">
                    Tentang Kami
                </a>
                <a href="{{ route('packages.index') }}"
                   class="text-gray-700 block px-3 py-2 text-base font-medium {{ request()->routeIs('packages.*') ? 'text-green-600 bg-green-50' : 'hover:text-green-600 hover:bg-gray-50' }}">
                    Paket Tour
                </a>
                <a href="{{ route('gallery.index') }}"
                   class="text-gray-700 block px-3 py-2 text-base font-medium {{ request()->routeIs('gallery.*') ? 'text-green-600 bg-green-50' : 'hover:text-green-600 hover:bg-gray-50' }}">
                    Galeri
                </a>
                <a href="{{ route('blog.index') }}"
                   class="text-gray-700 block px-3 py-2 text-base font-medium {{ request()->routeIs('blog.*') ? 'text-green-600 bg-green-50' : 'hover:text-green-600 hover:bg-gray-50' }}">
                    Blog
                </a>
                <a href="{{ route('contact') }}"
                   class="text-gray-700 block px-3 py-2 text-base font-medium {{ request()->routeIs('contact') ? 'text-green-600 bg-green-50' : 'hover:text-green-600 hover:bg-gray-50' }}">
                    Kontak
                </a>
                <div class="pt-4 pb-3 border-t border-gray-200">
                    <a href="https://wa.me/62818909769095?text=Halo,%20saya%20tertarik%20dengan%20paket%20wisata%20Jeep%20Merapi%20Adventure"
                       target="_blank"
                       class="bg-green-600 hover:bg-green-700 text-white block px-3 py-2 text-base font-medium rounded-lg mx-3 text-center">
                        Hubungi Kami via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>

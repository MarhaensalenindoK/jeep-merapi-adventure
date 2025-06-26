<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') - Jeep Merapi Adventure</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Additional Styles -->
    @stack('styles')
</head>
<body class="font-sans antialiased bg-admin-light">
    <div class="flex min-h-screen" x-data="{ sidebarOpen: false, profileDropdown: false }">
        <!-- Sidebar -->
        <div class="fixed inset-y-0 left-0 z-50 w-64 bg-admin-primary shadow-lg transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0"
             :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }">

            <!-- Logo/Brand -->
            <div class="flex items-center justify-center h-16 bg-admin-primary border-b border-admin-secondary/20">
                <h1 class="text-white text-xl font-bold">Admin Panel</h1>
            </div>

            <!-- Navigation Menu -->
            <nav class="mt-8 px-4">
                <div class="space-y-2">
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center px-4 py-3 text-white rounded-lg hover:bg-admin-secondary transition-colors duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-admin-secondary' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v10a2 2 0 01-2 2H10a2 2 0 01-2-2V5z"></path>
                        </svg>
                        <span class="text-base">Dashboard</span>
                    </a>

                    <!-- Manajemen Kategori -->
                    <a href="{{ route('admin.categories.index') }}"
                       class="flex items-center px-4 py-3 text-white rounded-lg hover:bg-admin-secondary transition-colors duration-200 {{ request()->routeIs('admin.categories.*') ? 'bg-admin-secondary' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        <span class="text-base">Manajemen Kategori</span>
                    </a>

                    <!-- Manajemen Paket -->
                    <a href="{{ route('admin.packages.index') }}"
                       class="flex items-center px-4 py-3 text-white rounded-lg hover:bg-admin-secondary transition-colors duration-200 {{ request()->routeIs('admin.packages.*') ? 'bg-admin-secondary' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        <span class="text-base">Manajemen Paket</span>
                    </a>

                    <!-- Manajemen Galeri -->
                    <a href="{{ route('admin.galleries.index') }}"
                       class="flex items-center px-4 py-3 text-white rounded-lg hover:bg-admin-secondary transition-colors duration-200 {{ request()->routeIs('admin.galleries.*') ? 'bg-admin-secondary' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-base">Manajemen Galeri</span>
                    </a>

                    <!-- Manajemen Blog -->
                    <a href="{{ route('admin.posts.index') }}"
                       class="flex items-center px-4 py-3 text-white rounded-lg hover:bg-admin-secondary transition-colors duration-200 {{ request()->routeIs('admin.posts.*') ? 'bg-admin-secondary' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <span class="text-base">Manajemen Blog</span>
                    </a>
                </div>
            </nav>

            <!-- Profile Section at Bottom -->
            <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-admin-secondary/20">
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                            class="flex items-center w-full px-4 py-3 text-white rounded-lg hover:bg-admin-secondary transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-admin-accent"
                            title="{{ Auth::user()->name }}">
                        <div class="w-8 h-8 bg-admin-accent rounded-full flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-admin-primary" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="flex-1 text-left">
                            <p class="text-base font-medium" title="{{ Auth::user()->name }}">
                                {{ strtoupper(collect(explode(' ', Auth::user()->name))->map(fn($word) => substr($word, 0, 1))->take(2)->join('')) }}
                            </p>
                            <p class="text-sm text-gray-300">Administrator</p>
                        </div>
                        <svg class="w-5 h-5 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         @click.away="open = false"
                         class="absolute bottom-full left-0 right-0 mb-2 bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden">

                        <a href="{{ route('profile.edit') }}"
                           class="flex items-center px-4 py-3 text-gray-700 hover:bg-admin-light transition-colors duration-200">
                            <svg class="w-5 h-5 mr-3 text-admin-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="text-lg">Profile</span>
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="flex items-center w-full px-4 py-3 text-gray-700 hover:bg-red-50 transition-colors duration-200 border-t border-gray-100">
                                <svg class="w-5 h-5 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                <span class="text-lg">Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 lg:ml-0">
            <!-- Mobile menu button -->
            <div class="lg:hidden">
                <button @click="sidebarOpen = !sidebarOpen"
                        class="fixed top-4 left-4 z-50 p-2 rounded-md bg-admin-primary text-white shadow-lg focus:outline-none focus:ring-2 focus:ring-admin-accent">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Overlay -->
            <div x-show="sidebarOpen"
                x-transition:enter="transition-opacity ease-linear duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-linear duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="sidebarOpen = false"
                class="fixed inset-0 z-40 bg-gray-600 bg-opacity-75 lg:hidden"></div>

            <!-- Page Header -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center py-6">
                        <div class="flex-1 min-w-0">
                            <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                                @yield('title', 'Dashboard')
                            </h1>
                            @if(isset($breadcrumbs))
                                <nav class="flex mt-2" aria-label="Breadcrumb">
                                    <!-- Mobile Breadcrumb -->
                                    <ol class="flex items-center space-x-2 sm:hidden">
                                        @foreach($breadcrumbs as $breadcrumb)
                                            <li>
                                                <div class="flex items-center">
                                                    @if(!$loop->first)
                                                        <svg class="flex-shrink-0 h-4 w-4 text-gray-300 mx-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    @endif
                                                    @if(isset($breadcrumb['url']))
                                                        <a href="{{ $breadcrumb['url'] }}" class="text-sm text-gray-500 hover:text-gray-700 {{ $loop->count > 2 && !$loop->last && !$loop->first ? 'hidden' : '' }}">
                                                            {{ $loop->count > 2 && !$loop->last && !$loop->first ? '...' : Str::limit($breadcrumb['title'], 10) }}
                                                        </a>
                                                    @else
                                                        <span class="text-sm text-gray-500">{{ Str::limit($breadcrumb['title'], 15) }}</span>
                                                    @endif
                                                </div>
                                            </li>
                                        @endforeach
                                    </ol>

                                    <!-- Desktop Breadcrumb -->
                                    <ol class="hidden sm:flex items-center space-x-4">
                                        @foreach($breadcrumbs as $breadcrumb)
                                            <li>
                                                <div class="flex items-center">
                                                    @if(!$loop->first)
                                                        <svg class="flex-shrink-0 h-5 w-5 text-gray-300 mr-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    @endif
                                                    @if(isset($breadcrumb['url']))
                                                        <a href="{{ $breadcrumb['url'] }}" class="text-lg text-gray-500 hover:text-gray-700">{{ $breadcrumb['title'] }}</a>
                                                    @else
                                                        <span class="text-lg text-gray-500">{{ $breadcrumb['title'] }}</span>
                                                    @endif
                                                </div>
                                            </li>
                                        @endforeach
                                    </ol>
                                </nav>
                            @endif
                        </div>
                        <div class="flex items-center space-x-4">
                            @yield('header-actions')
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1">
                <div class="py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <!-- Alert Messages -->
                        @if(session('success'))
                            <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                                <div class="flex">
                                    <svg class="flex-shrink-0 h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <div class="ml-3">
                                        <p class="text-lg font-medium text-green-800">{{ session('success') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                                <div class="flex">
                                    <svg class="flex-shrink-0 h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                    </svg>
                                    <div class="ml-3">
                                        <p class="text-lg font-medium text-red-800">{{ session('error') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Main Content Area -->
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- jQuery (required for Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Additional Scripts -->
    @stack('scripts')
</body>
</html>

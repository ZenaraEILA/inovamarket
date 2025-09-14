<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - {{ config('app.name', 'InovaMarket') }} - @yield('title')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-900 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0" 
               :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }">
            <div class="flex items-center justify-center h-16 bg-gray-800">
                <h1 class="text-white text-xl font-bold">InovaMarket Admin</h1>
            </div>
            
            <nav class="mt-8">
                <div class="px-4 space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 text-gray-300 rounded-lg hover:bg-gray-800 hover:text-white transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-white' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                        </svg>
                        Dashboard
                    </a>
                    
                    <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-2 text-gray-300 rounded-lg hover:bg-gray-800 hover:text-white transition-colors {{ request()->routeIs('admin.products.*') ? 'bg-gray-800 text-white' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        Produk
                    </a>
                    
                    <a href="{{ route('admin.categories.index') }}" class="flex items-center px-4 py-2 text-gray-300 rounded-lg hover:bg-gray-800 hover:text-white transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-gray-800 text-white' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        Kategori
                    </a>
                    
                    <a href="{{ route('admin.orders.index') }}" class="flex items-center px-4 py-2 text-gray-300 rounded-lg hover:bg-gray-800 hover:text-white transition-colors {{ request()->routeIs('admin.orders.*') ? 'bg-gray-800 text-white' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Pesanan
                    </a>
                    
                    <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-2 text-gray-300 rounded-lg hover:bg-gray-800 hover:text-white transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-gray-800 text-white' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-.5a4 4 0 110-8 4 4 0 010 8z"/>
                        </svg>
                        Users
                    </a>
                    
                    <div class="border-t border-gray-700 my-4"></div>
                    
                    <a href="{{ route('home') }}" class="flex items-center px-4 py-2 text-gray-300 rounded-lg hover:bg-gray-800 hover:text-white transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke Website
                    </a>
                </div>
            </nav>
        </aside>
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top bar -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center">
                        <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-gray-600 lg:hidden">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                        <h2 class="ml-4 text-xl font-semibold text-gray-800 lg:ml-0">@yield('header', 'Dashboard')</h2>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-700">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-500 hover:text-gray-700 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </header>
            
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mx-6 mt-4 rounded-lg" role="alert">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mx-6 mt-4 rounded-lg" role="alert">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        {{ session('error') }}
                    </div>
                </div>
            @endif
            
            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                <div class="container mx-auto px-6 py-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    
    <!-- Sidebar Overlay (Mobile) -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-black opacity-50 lg:hidden" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        if (!window.tailwind) {
            document.head.insertAdjacentHTML('beforeend', '<script src="https://cdn.tailwindcss.com"><\/script>');
        }
    </script>
    <!-- Alpine.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.3/cdn.min.js" defer></script>
</body>
</html>
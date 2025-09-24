<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'InovaMarket') }} - @yield('title', 'Marketplace Siswa')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600 hover:text-blue-700 transition-colors">
                            InovaMarket
                        </a>
                    </div>
                    
                    <!-- Desktop Navigation -->
                    <div class="hidden md:flex items-center space-x-6">
                        <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 transition-colors {{ request()->routeIs('home') ? 'text-blue-600 font-medium' : '' }}">
                            Beranda
                        </a>
                        <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-blue-600 transition-colors {{ request()->routeIs('products.*') ? 'text-blue-600 font-medium' : '' }}">
                            Produk
                        </a>
                        
                        @guest
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 transition-colors">Login</a>
                            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                Daftar
                            </a>
                        @else
                            @if(auth()->user()->isUser())
                                <a href="{{ route('cart.index') }}" class="relative text-gray-700 hover:text-blue-600 transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 1.5M7 13l1.5 1.5M17 21a2 2 0 100-4 2 2 0 000 4zM9 21a2 2 0 100-4 2 2 0 000 4z"/>
                                    </svg>
                                    @if(isset($cartCount) && $cartCount > 0)
                                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                            {{ $cartCount }}
                                        </span>
                                    @endif
                                </a>
                            @endif
                            
<!-- Update bagian navbar di resources/views/layouts/app.blade.php -->

<!-- User Dropdown Section (replace existing dropdown) -->
<div class="relative" x-data="{ open: false }">
    <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 transition-colors">
        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
            <span class="text-sm font-bold text-blue-600">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
        </div>
        <span class="hidden md:block">{{ auth()->user()->name }}</span>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>
    
    <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50">
        @if(auth()->user()->isUser())
            <!-- User Menu Items -->
            <div class="px-4 py-2 border-b border-gray-100">
                <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
            </div>
            
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600' : '' }}">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                    </svg>
                    Dashboard
                </div>
            </a>
            
            <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 {{ request()->routeIs('profile') ? 'bg-blue-50 text-blue-600' : '' }}">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Profil Saya
                </div>
            </a>
            
            <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 {{ request()->routeIs('orders.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Pesanan Saya
                </div>
            </a>
            
            <a href="{{ route('payment-methods') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 {{ request()->routeIs('payment-methods') ? 'bg-blue-50 text-blue-600' : '' }}">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                    Metode Pembayaran
                </div>
            </a>
            
            <a href="{{ route('settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 {{ request()->routeIs('settings') ? 'bg-blue-50 text-blue-600' : '' }}">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Pengaturan
                </div>
            </a>
        @endif
        
        @if(auth()->user()->isAdmin())
            <!-- Admin Menu Items -->
            <div class="px-4 py-2 border-b border-gray-100">
                <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 mt-1">
                    Administrator
                </span>
            </div>
            
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    Admin Panel
                </div>
            </a>
            
            <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Profil Saya
                </div>
            </a>
        @endif
        
        <div class="border-t border-gray-100 my-1"></div>
        <form method="POST" action="{{ route('logout') }}" class="block">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </div>
            </button>
        </form>
    </div>

<!-- Profile Modal -->
<div id="profileModal" class="fixed inset-0 z-50 hidden" style="background-color: rgba(0, 0, 0, 0.5);">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Profil Saya</h3>
                    <button onclick="closeProfileModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
            
            <div class="px-6 py-4">
                <div class="text-center mb-6">
                    <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-blue-600">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-900">{{ auth()->user()->name }}</h4>
                    <p class="text-gray-600">{{ auth()->user()->email }}</p>
                </div>
                
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-500">Role:</span>
                        <span class="text-sm text-gray-900 capitalize">
                            <span class="px-2 py-1 rounded-full text-xs font-medium {{ auth()->user()->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800' }}">
                                {{ auth()->user()->role }}
                            </span>
                        </span>
                    </div>
                    
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-500">Telepon:</span>
                        <span class="text-sm text-gray-900">{{ auth()->user()->phone ?? 'Belum diisi' }}</span>
                    </div>
                    
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-500">Bergabung:</span>
                        <span class="text-sm text-gray-900">{{ auth()->user()->created_at->format('d M Y') }}</span>
                    </div>
                    
                    @if(auth()->user()->isUser())
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Total Pesanan:</span>
                            <span class="text-sm text-gray-900">{{ auth()->user()->orders->count() }}</span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Total Belanja:</span>
                            <span class="text-sm text-gray-900">Rp {{ number_format(auth()->user()->orders->where('status', 'completed')->sum('total_price'), 0, ',', '.') }}</span>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 rounded-b-lg">
                <div class="flex space-x-3">
                    <button onclick="editProfile()" class="flex-1 bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium">
                        Edit Profil
                    </button>
                    <button onclick="closeProfileModal()" class="flex-1 bg-gray-100 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-200 transition-colors text-sm font-medium">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>



                            {{-- <!-- User Dropdown -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 transition-colors">
                                    <span>{{ auth()->user()->name }}</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                
                                <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50">
                                    @if(auth()->user()->isAdmin())
                                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">Admin Panel</a>
                                    @endif
                                    
                                    <div class="border-t border-gray-100 my-1"></div>
                                    <form method="POST" action="{{ route('logout') }}" class="block">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600">
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div> --}}
                        @endguest
                    </div>
                    
                    <!-- Mobile menu button -->
                    <div class="md:hidden">
                        <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-500 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Mobile Navigation -->
            <div x-show="mobileMenuOpen" x-transition class="md:hidden border-t border-gray-200 bg-white" x-data="{ mobileMenuOpen: false }">
                <div class="px-4 py-3 space-y-3">
                    <a href="{{ route('home') }}" class="block text-gray-700 hover:text-blue-600 transition-colors">Beranda</a>
                    <a href="{{ route('products.index') }}" class="block text-gray-700 hover:text-blue-600 transition-colors">Produk</a>
                    
                    @guest
                        <a href="{{ route('login') }}" class="block text-gray-700 hover:text-blue-600 transition-colors">Login</a>
                        <a href="{{ route('register') }}" class="block text-gray-700 hover:text-blue-600 transition-colors">Daftar</a>
                    @else
                        @if(auth()->user()->isUser())
                            <a href="{{ route('cart.index') }}" class="block text-gray-700 hover:text-blue-600 transition-colors">
                                Keranjang @if(isset($cartCount) && $cartCount > 0)({{ $cartCount }})@endif
                            </a>
                            <a href="{{ route('dashboard') }}" class="block text-gray-700 hover:text-blue-600 transition-colors">Dashboard</a>
                            <a href="{{ route('orders.index') }}" class="block text-gray-700 hover:text-blue-600 transition-colors">Pesanan Saya</a>
                        @endif
                        
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="block text-gray-700 hover:text-blue-600 transition-colors">Admin Panel</a>
                        @endif
                        
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" class="w-full text-left text-gray-700 hover:text-red-600 transition-colors">
                                Logout
                            </button>
                        </form>
                    @endguest
                </div>
            </div>
        </nav>
        
        <!-- Alert Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mx-4 mt-4 rounded-lg" role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif
        
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mx-4 mt-4 rounded-lg" role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
        
        <!-- Footer -->
        <footer class="bg-gray-900 text-white mt-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="col-span-1 md:col-span-2">
                        <h3 class="text-2xl font-bold mb-4">InovaMarket</h3>
                        <p class="text-gray-400 mb-4">
                            Platform marketplace untuk produk dan jasa karya siswa. 
                            Mendukung kreativitas dan kewirausahaan generasi muda.
                        </p>
                    </div>
                    
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Menu</h4>
                        <ul class="space-y-2">
                            <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition-colors">Beranda</a></li>
                            <li><a href="{{ route('products.index') }}" class="text-gray-400 hover:text-white transition-colors">Produk</a></li>
                            @guest
                                <li><a href="{{ route('register') }}" class="text-gray-400 hover:text-white transition-colors">Daftar</a></li>
                            @endguest
                        </ul>
                    </div>
                    
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                        <ul class="space-y-2 text-gray-400">
                            <li>Email: info@inovamarket.com</li>
                            <li>Phone: +62 812-3456-7890</li>
                            <li>Malang, Jawa Timur</li>
                        </ul>
                    </div>
                </div>
                
                <div class="border-t border-gray-800 pt-8 mt-8 text-center text-gray-400">
                    <p>&copy; {{ date('Y') }} InovaMarket. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
    <script>
function showProfileModal() {
    document.getElementById('profileModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeProfileModal() {
    document.getElementById('profileModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}



// Close modal when clicking outside
document.getElementById('profileModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeProfileModal();
    }
});
</script>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js for interactivity -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.3/cdn.min.js" defer></script>
</body>
</html>
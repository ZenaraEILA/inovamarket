@extends('layouts.app')

@section('title', 'Marketplace Siswa Kreatif')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-blue-600 to-purple-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                Temukan Karya
                <span class="text-yellow-300">Siswa Kreatif</span>
            </h1>
            <p class="text-xl md:text-2xl text-blue-100 mb-8 max-w-3xl mx-auto">
                Platform marketplace untuk produk dan jasa berkualitas buatan siswa. 
                Dukung kreativitas generasi muda Indonesia!
            </p>
            <div class="space-y-4 sm:space-y-0 sm:space-x-4 sm:flex sm:justify-center">
                <a href="{{ route('products.index') }}" class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition-colors">
                    Jelajahi Produk
                </a>
                @guest
                    <a href="{{ route('register') }}" class="inline-block border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition-colors">
                        Mulai Jual Sekarang
                    </a>
                @endguest
            </div>
        </div>
    </div>
</div>

<!-- Categories Section -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Kategori Produk</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Berbagai macam produk dan jasa kreatif dari siswa berbakat
            </p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($categories as $category)
                <div class="bg-gray-50 rounded-xl p-6 hover:shadow-lg transition-shadow cursor-pointer" 
                     onclick="window.location='{{ route('products.category', $category) }}'">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-semibold text-gray-900">{{ $category->name }}</h3>
                        <span class="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded">
                            {{ $category->products_count }} produk
                        </span>
                    </div>
                    <p class="text-gray-600 mb-4">{{ $category->description }}</p>
                    <div class="flex items-center text-blue-600 hover:text-blue-700 transition-colors">
                        <span class="text-sm font-medium">Lihat Produk</span>
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Featured Products -->
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Produk Terbaru</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Produk dan jasa terbaik dari siswa kreatif
            </p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredProducts as $product)
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow overflow-hidden">
                    <div class="aspect-w-1 aspect-h-1 bg-gray-200">
                        @if($product->image)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-300 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                {{ $product->category->name }}
                            </span>
                            <span class="text-sm text-gray-500">Stok: {{ $product->stock }}</span>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>
                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ Str::limit($product->description, 60) }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-bold text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            <a href="{{ route('products.show', $product) }}" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition-colors">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('products.index') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                Lihat Semua Produk
            </a>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="py-16 bg-blue-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Siap Memulai?</h2>
        <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
            Bergabunglah dengan komunitas siswa kreatif dan mulai jual produk atau jasa Anda hari ini!
        </p>
        @guest
            <a href="{{ route('register') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition-colors">
                Daftar Sekarang
            </a>
        @else
            @if(auth()->user()->isUser())
                <a href="{{ route('dashboard') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition-colors">
                    Ke Dashboard
                </a>
            @endif
        @endguest
    </div>
</div>
@endsection
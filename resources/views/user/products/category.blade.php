<!-- resources/views/user/products/category.blade.php -->
@extends('layouts.app')

@section('title', $category->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <nav class="text-sm mb-4">
            <ol class="list-none p-0 inline-flex">
                <li class="flex items-center">
                    <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-700">Beranda</a>
                    <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </li>
                <li class="flex items-center">
                    <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-700">Produk</a>
                    <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </li>
                <li class="text-gray-500">{{ $category->name }}</li>
            </ol>
        </nav>
        
        <h1 class="text-3xl font-bold text-gray-900">{{ $category->name }}</h1>
        @if($category->description)
            <p class="text-gray-600 mt-2">{{ $category->description }}</p>
        @endif
        <p class="text-sm text-gray-500 mt-1">{{ $products->total() }} produk ditemukan</p>
    </div>
    
    <!-- Filter & Sort -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
        <form method="GET" action="{{ route('products.category', $category) }}" class="space-y-4 lg:space-y-0 lg:flex lg:items-center lg:space-x-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Cari produk dalam kategori ini..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            
            <div class="lg:w-48">
                <select name="sort" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga Terendah</option>
                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama A-Z</option>
                </select>
            </div>
            
            <button type="submit" class="w-full lg:w-auto bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                Terapkan Filter
            </button>
        </form>
    </div>
    
    <!-- Products Grid -->
    @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
            @foreach($products as $product)
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow overflow-hidden group">
                    <div class="aspect-w-1 aspect-h-1 bg-gray-200 relative overflow-hidden">
                        @if($product->image)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-full h-48 bg-gray-300 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                        
                        @if($product->stock <= 5 && $product->stock > 0)
                            <div class="absolute top-2 left-2">
                                <span class="bg-orange-500 text-white text-xs font-medium px-2 py-1 rounded">
                                    Stok Terbatas
                                </span>
                            </div>
                        @elseif($product->stock == 0)
                            <div class="absolute top-2 left-2">
                                <span class="bg-red-500 text-white text-xs font-medium px-2 py-1 rounded">
                                    Habis
                                </span>
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
                        
                        <h3 class="font-semibold text-gray-900 mb-2 line-clamp-1">{{ $product->name }}</h3>
                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ Str::limit($product->description, 80) }}</p>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-bold text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            <a href="{{ route('products.show', $product) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition-colors">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $products->appends(request()->query())->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada produk ditemukan</h3>
            <p class="text-gray-600 mb-4">
                @if(request('search'))
                    Tidak ada produk yang cocok dengan pencarian "{{ request('search') }}" dalam kategori {{ $category->name }}.
                @else
                    Belum ada produk dalam kategori {{ $category->name }}.
                @endif
            </p>
            <div class="space-x-4">
                @if(request('search'))
                    <a href="{{ route('products.category', $category) }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        Lihat Semua Produk
                    </a>
                @endif
                <a href="{{ route('products.index') }}" class="bg-gray-100 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-200 transition-colors">
                    Jelajahi Kategori Lain
                </a>
            </div>
        </div>
    @endif

    <!-- Related Categories -->
    @if(isset($relatedCategories) && $relatedCategories->count() > 0)
        <div class="mt-12 border-t border-gray-200 pt-8">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Kategori Lainnya</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach($relatedCategories as $relatedCategory)
                    <a href="{{ route('products.category', $relatedCategory) }}" 
                       class="block p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors text-center">
                        <h3 class="font-medium text-gray-900 text-sm">{{ $relatedCategory->name }}</h3>
                        <p class="text-xs text-gray-500 mt-1">{{ $relatedCategory->products_count }} produk</p>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
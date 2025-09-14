@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-12">
        <!-- Product Image -->
        <div class="aspect-w-1 aspect-h-1">
            @if($product->image)
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-96 object-cover rounded-lg shadow-lg">
            @else
                <div class="w-full h-96 bg-gray-300 rounded-lg flex items-center justify-center">
                    <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            @endif
        </div>
        
        <!-- Product Info -->
        <div>
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
                    <li class="text-gray-500">{{ $product->name }}</li>
                </ol>
            </nav>
            
            <div class="mb-4">
                <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded">
                    {{ $product->category->name }}
                </span>
            </div>
            
            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
            
            <div class="text-3xl font-bold text-blue-600 mb-6">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </div>
            
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Deskripsi</h3>
                <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
            </div>
            
            <div class="flex items-center space-x-6 mb-6">
                <div class="flex items-center">
                    <span class="text-sm text-gray-600 mr-2">Stok:</span>
                    <span class="font-medium {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                        {{ $product->stock > 0 ? $product->stock . ' tersedia' : 'Habis' }}
                    </span>
                </div>
            </div>
            
            @auth
                @if(auth()->user()->isUser() && $product->stock > 0)
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="mb-6">
                        @csrf
                        <div class="flex items-center space-x-4 mb-4">
                            <label for="quantity" class="text-sm font-medium text-gray-700">Jumlah:</label>
                            <input type="number" name="quantity" id="quantity" min="1" max="{{ $product->stock }}" value="1" 
                                   class="w-20 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        
                        <button type="submit" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                            Tambah ke Keranjang
                        </button>
                    </form>
                @endif
            @else
                <div class="bg-gray-100 rounded-lg p-4 text-center">
                    <p class="text-gray-600 mb-4">Silakan login untuk membeli produk ini</p>
                    <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        Login
                    </a>
                </div>
            @endauth
        </div>
    </div>
    
    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="border-t border-gray-200 pt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Produk Serupa</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow overflow-hidden">
                        <div class="aspect-w-1 aspect-h-1 bg-gray-200">
                            @if($related->image)
                                <img src="{{ $related->image_url }}" alt="{{ $related->name }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-300 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 mb-2">{{ $related->name }}</h3>
                            <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ Str::limit($related->description, 60) }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-blue-600">Rp {{ number_format($related->price, 0, ',', '.') }}</span>
                                <a href="{{ route('products.show', $related) }}" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition-colors">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
<script src="https://cdn.tailwindcss.com"></script>
@endsection
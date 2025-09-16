@extends('layouts.admin')

@section('title', 'Detail Produk')
@section('header', 'Detail Produk')

@section('content')
<div class="mb-6">
    <nav class="text-sm mb-4">
        <ol class="list-none p-0 inline-flex">
            <li class="flex items-center">
                <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-700">Dashboard</a>
                <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </li>
            <li class="flex items-center">
                <a href="{{ route('admin.products.index') }}" class="text-blue-600 hover:text-blue-700">Produk</a>
                <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </li>
            <li class="text-gray-500">Detail Produk</li>
        </ol>
    </nav>
    
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-900">Detail Produk</h1>
        <div class="space-x-3">
            <a href="{{ route('admin.products.edit', $product) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                Edit Produk
            </a>
            <a href="{{ route('admin.products.index') }}" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors">
                Kembali
            </a>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Product Image -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Gambar Produk</h2>
        <div class="aspect-w-1 aspect-h-1">
            @if($product->image)
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-64 object-cover rounded-lg shadow-sm">
            @else
                <div class="w-full h-64 bg-gray-300 rounded-lg flex items-center justify-center">
                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            @endif
        </div>
    </div>
    
    <!-- Product Info -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi Produk</h2>
        
        <div class="space-y-4">
            <div>
                <label class="text-sm font-medium text-gray-500">Nama Produk</label>
                <p class="text-lg font-semibold text-gray-900">{{ $product->name }}</p>
            </div>
            
            <div>
                <label class="text-sm font-medium text-gray-500">Kategori</label>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 mt-1">
                    {{ $product->category->name }}
                </span>
            </div>
            
            <div>
                <label class="text-sm font-medium text-gray-500">Harga</label>
                <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-medium text-gray-500">Stok</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $product->stock }}</p>
                </div>
                
                <div>
                    <label class="text-sm font-medium text-gray-500">Status</label>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium mt-1 {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </div>
            </div>
            
            <div>
                <label class="text-sm font-medium text-gray-500">Deskripsi</label>
                <p class="text-gray-700 leading-relaxed mt-1">{{ $product->description }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Product Statistics -->
<div class="mt-8 bg-white rounded-lg shadow-sm border border-gray-200 p-6">
    <h2 class="text-lg font-semibold text-gray-900 mb-4">Statistik Produk</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-blue-50 rounded-lg p-4">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-blue-600">Total Terjual</p>
                    <p class="text-lg font-semibold text-blue-900">
                        {{ $product->orderItems->sum('quantity') ?? 0 }}
                    </p>
                </div>
            </div>
        </div>
        
        <div class="bg-green-50 rounded-lg p-4">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-600">Total Pendapatan</p>
                    <p class="text-lg font-semibold text-green-900">
                        Rp {{ number_format($product->orderItems->sum(function($item) { return $item->quantity * $item->price; }) ?? 0, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>
        
        <div class="bg-yellow-50 rounded-lg p-4">
            <div class="flex items-center">
                <div class="p-2 bg-yellow-100 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-yellow-600">Total Pesanan</p>
                    <p class="text-lg font-semibold text-yellow-900">
                        {{ $product->orderItems->count() ?? 0 }}
                    </p>
                </div>
            </div>
        </div>
        
        <div class="bg-purple-50 rounded-lg p-4">
            <div class="flex items-center">
                <div class="p-2 bg-purple-100 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-purple-600">Dibuat</p>
                    <p class="text-lg font-semibold text-purple-900">
                        {{ $product->created_at->format('d M Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
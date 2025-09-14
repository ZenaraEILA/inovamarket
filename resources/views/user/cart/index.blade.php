@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Keranjang Belanja</h1>
        <p class="text-gray-600">Review produk yang akan Anda beli</p>
    </div>
    
    @if(count($cartItems) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-semibold text-gray-900">Item Keranjang ({{ count($cartItems) }})</h2>
                            <form action="{{ route('cart.clear') }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-700 text-sm font-medium" 
                                        onclick="return confirm('Yakin ingin mengosongkan keranjang?')">
                                    Kosongkan Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <div class="space-y-6">
                            @foreach($cartItems as $item)
                                <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg">
                                    <div class="flex-shrink-0 w-20 h-20">
                                        @if($item['product']->image)
                                            <img src="{{ $item['product']->image_url }}" alt="{{ $item['product']->name }}" class="w-full h-full object-cover rounded-lg">
                                        @else
                                            <div class="w-full h-full bg-gray-300 rounded-lg flex items-center justify-center">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-gray-900">{{ $item['product']->name }}</h3>
                                        <p class="text-sm text-gray-600">{{ $item['product']->category->name }}</p>
                                        <p class="text-sm text-blue-600 font-medium">Rp {{ number_format($item['product']->price, 0, ',', '.') }}</p>
                                    </div>
                                    
                                    <div class="flex items-center space-x-3">
                                        <form action="{{ route('cart.update', $item['product']) }}" method="POST" class="flex items-center space-x-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" 
                                                   min="1" max="{{ $item['product']->stock }}"
                                                   class="w-16 px-2 py-1 border border-gray-300 rounded text-center focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                   onchange="this.form.submit()">
                                        </form>
                                        
                                        <div class="text-right">
                                            <p class="font-semibold text-gray-900">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</p>
                                        </div>
                                        
                                        <form action="{{ route('cart.remove', $item['product']) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-700 p-1" 
                                                    onclick="return confirm('Hapus item dari keranjang?')">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 sticky top-4">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900">Ringkasan Pesanan</h2>
                    </div>
                    
                    <div class="p-6">
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal ({{ count($cartItems) }} item)</span>
                                <span class="font-medium text-gray-900">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Ongkos Kirim</span>
                                <span class="font-medium text-green-600">GRATIS</span>
                            </div>
                            <div class="border-t border-gray-200 pt-3">
                                <div class="flex justify-between">
                                    <span class="text-lg font-semibold text-gray-900">Total</span>
                                    <span class="text-lg font-bold text-blue-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <a href="{{ route('checkout') }}" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition-colors block text-center">
                            Lanjut ke Checkout
                        </a>
                        
                        <a href="{{ route('products.index') }}" class="w-full mt-3 bg-gray-100 text-gray-700 py-3 px-6 rounded-lg font-semibold hover:bg-gray-200 transition-colors block text-center">
                            Lanjut Belanja
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 1.5M7 13l1.5 1.5M17 21a2 2 0 100-4 2 2 0 000 4zM9 21a2 2 0 100-4 2 2 0 000 4z"/>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Keranjang Kosong</h3>
            <p class="text-gray-600 mb-6">Belum ada produk di keranjang Anda. Mari mulai berbelanja!</p>
            <a href="{{ route('products.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                Mulai Belanja
            </a>
        </div>
    @endif
</div>
@endsection
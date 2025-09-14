@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Checkout</h1>
        <p class="text-gray-600">Review dan konfirmasi pesanan Anda</p>
    </div>
    
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Order Details -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900">Detail Pesanan</h2>
                    </div>
                    
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach($cartItems as $item)
                                <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg">
                                    <div class="flex-shrink-0 w-16 h-16">
                                        @if($item['product']->image)
                                            <img src="{{ $item['product']->image_url }}" alt="{{ $item['product']->name }}" class="w-full h-full object-cover rounded-lg">
                                        @else
                                            <div class="w-full h-full bg-gray-300 rounded-lg flex items-center justify-center">
                                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-gray-900">{{ $item['product']->name }}</h3>
                                        <p class="text-sm text-gray-600">{{ $item['product']->category->name }}</p>
                                        <p class="text-sm text-gray-600">Jumlah: {{ $item['quantity'] }}</p>
                                    </div>
                                    
                                    <div class="text-right">
                                        <p class="font-semibold text-gray-900">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <!-- Order Notes -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900">Catatan Pesanan</h2>
                    </div>
                    
                    <div class="p-6">
                        <textarea name="notes" rows="3" placeholder="Tambahkan catatan untuk penjual (opsional)"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                    </div>
                </div>
            </div>
            
            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 sticky top-4">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900">Ringkasan Pembayaran</h2>
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
                            <div class="flex justify-between">
                                <span class="text-gray-600">Biaya Admin</span>
                                <span class="font-medium text-green-600">GRATIS</span>
                            </div>
                            <div class="border-t border-gray-200 pt-3">
                                <div class="flex justify-between">
                                    <span class="text-lg font-semibold text-gray-900">Total Pembayaran</span>
                                    <span class="text-lg font-bold text-blue-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-blue-50 rounded-lg p-4 mb-6">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-blue-900">Simulasi Pesanan</p>
                                    <p class="text-sm text-blue-700 mt-1">Ini adalah simulasi pesanan. Tidak ada pembayaran nyata yang diperlukan.</p>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition-colors mb-3">
                            Konfirmasi Pesanan
                        </button>
                        
                        <a href="{{ route('cart.index') }}" class="w-full bg-gray-100 text-gray-700 py-3 px-6 rounded-lg font-semibold hover:bg-gray-200 transition-colors block text-center">
                            Kembali ke Keranjang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Pesanan Saya</h1>
        <p class="text-gray-600">Lacak status pesanan Anda</p>
    </div>
    
    @if($orders->count() > 0)
        <div class="space-y-6">
            @foreach($orders as $order)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Order #{{ $order->id }}</h3>
                                <p class="text-sm text-gray-600">{{ $order->created_at->format('d M Y, H:i') }}</p>
                            </div>
                            <div class="mt-2 sm:mt-0 flex items-center space-x-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $order->status_badge }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                                <span class="text-lg font-bold text-blue-600">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="border-t border-gray-200 pt-4">
                            <div class="space-y-3">
                                @foreach($order->orderItems as $item)
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0 w-12 h-12">
                                            @if($item->product->image)
                                                <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-12 h-12 object-cover rounded-lg">
                                            @else
                                                <div class="w-12 h-12 bg-gray-300 rounded-lg flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="text-sm font-medium text-gray-900">{{ $item->product->name }}</h4>
                                            <p class="text-sm text-gray-600">{{ $item->quantity }}x - Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="text-sm font-medium text-gray-900">
                                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="mt-4 flex justify-end">
                            <a href="{{ route('orders.show', $order) }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                Lihat Detail →
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-8">
            {{ $orders->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Pesanan</h3>
            <p class="text-gray-600 mb-6">Anda belum memiliki pesanan. Mulai berbelanja sekarang!</p>
            <a href="{{ route('products.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                Mulai Belanja
            </a>
        </div>
    @endif
</div>
@endsection
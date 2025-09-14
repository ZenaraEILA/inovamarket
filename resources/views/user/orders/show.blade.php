@extends('layouts.app')

@section('title', 'Detail Pesanan #' . $order->id)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <nav class="text-sm mb-4">
            <ol class="list-none p-0 inline-flex">
                <li class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-700">Dashboard</a>
                    <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </li>
                <li class="flex items-center">
                    <a href="{{ route('orders.index') }}" class="text-blue-600 hover:text-blue-700">Pesanan</a>
                    <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </li>
                <li class="text-gray-500">Order #{{ $order->id }}</li>
            </ol>
        </nav>
        
        <h1 class="text-3xl font-bold text-gray-900">Detail Pesanan #{{ $order->id }}</h1>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Order Details -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">Informasi Pesanan</h2>
                </div>
                
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Tanggal Pesanan</p>
                            <p class="text-sm text-gray-900">{{ $order->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Status</p>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $order->status_badge }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        @if($order->notes)
                            <div class="sm:col-span-2">
                                <p class="text-sm font-medium text-gray-500">Catatan</p>
                                <p class="text-sm text-gray-900">{{ $order->notes }}</p>
                            </div>
                        @endif
                    </div>
                    
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Item Pesanan</h3>
                    <div class="space-y-4">
                        @foreach($order->orderItems as $item)
                            <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg">
                                <div class="flex-shrink-0 w-16 h-16">
                                    @if($item->product->image)
                                        <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded-lg">
                                    @else
                                        <div class="w-16 h-16 bg-gray-300 rounded-lg flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900">{{ $item->product->name }}</h4>
                                    <p class="text-sm text-gray-600">{{ $item->product->category->name }}</p>
                                    <p class="text-sm text-gray-600">
                                        {{ $item->quantity }}x Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </p>
                                </div>
                                
                                <div class="text-right">
                                    <p class="font-semibold text-gray-900">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
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
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal ({{ $order->orderItems->count() }} item)</span>
                            <span class="font-medium text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Ongkos Kirim</span>
                            <span class="font-medium text-green-600">GRATIS</span>
                        </div>
                        <div class="border-t border-gray-200 pt-3">
                            <div class="flex justify-between">
                                <span class="text-lg font-semibold text-gray-900">Total</span>
                                <span class="text-lg font-bold text-blue-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="bg-blue-50 rounded-lg p-4">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-blue-900">Status Pesanan</p>
                                    <p class="text-sm text-blue-700 mt-1">
                                        @switch($order->status)
                                            @case('pending')
                                                Pesanan Anda sedang diproses oleh admin.
                                                @break
                                            @case('confirmed')
                                                Pesanan Anda telah dikonfirmasi dan sedang dipersiapkan.
                                                @break
                                            @case('completed')
                                                Pesanan Anda telah selesai. Terima kasih!
                                                @break
                                            @case('cancelled')
                                                Pesanan Anda telah dibatalkan.
                                                @break
                                        @endswitch
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <a href="{{ route('orders.index') }}" class="w-full bg-gray-100 text-gray-700 py-3 px-6 rounded-lg font-semibold hover:bg-gray-200 transition-colors block text-center">
                            Kembali ke Pesanan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')

@section('title', 'Detail Pesanan')

@section('header', 'Detail Pesanan #{{ $order->id }}')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Detail Pesanan #{{ $order->id }}</h1>
        <div class="space-x-2 mt-4 sm:mt-0">
            <a href="{{ route('admin.orders.index') }}" class="inline-block bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                Kembali ke Pesanan
            </a>
            <a href="{{ route('admin.orders.edit', $order) }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                Edit
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <h2 class="text-lg font-semibold text-gray-800 mb-2">Informasi Pelanggan</h2>
            <p><strong>Nama:</strong> {{ $order->user->name }}</p>
            <p><strong>Email:</strong> {{ $order->user->email }}</p>
            <p><strong>Tanggal Pesanan:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
        </div>
        <div>
            <h2 class="text-lg font-semibold text-gray-800 mb-2">Status Pesanan</h2>
            <p>
                <strong>Status:</strong>
                <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full 
                    {{ $order->status == 'completed' ? 'bg-green-100 text-green-800' : ($order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800') }}">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
            <p><strong>Total:</strong> ${{ number_format($order->total_amount, 2) }}</p>
        </div>
    </div>

    @if($order->notes)
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-2">Catatan Pesanan</h2>
        <p class="text-gray-700">{{ $order->notes }}</p>
    </div>
    @endif

    <div>
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Item Pesanan</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($order->orderItems as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->product->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->quantity }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${{ number_format($item->price, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${{ number_format($item->quantity * $item->price, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
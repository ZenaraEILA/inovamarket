<!-- resources/views/user/buy-now.blade.php -->
@extends('layouts.app')

@section('title', 'Beli Sekarang')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Beli Sekarang</h1>
        <p class="text-gray-600">Lengkapi informasi untuk menyelesaikan pembelian</p>
    </div>
    
    <form action="{{ route('buy-now.process', $product) }}" method="POST" x-data="{ 
        paymentMethod: 'balance',
        showNewAddress: false,
        userBalance: {{ $userBalance }},
        totalAmount: {{ $total }}
    }">
        @csrf
        <input type="hidden" name="quantity" value="{{ $quantity }}">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Form -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Product Info -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Detail Produk</h2>
                    <div class="flex items-start space-x-4">
                        <div class="w-20 h-20 bg-gray-200 rounded-lg flex-shrink-0">
                            @if($product->image)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-20 h-20 object-cover rounded-lg">
                            @else
                                <div class="w-20 h-20 bg-gray-300 rounded-lg flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $product->category->name }}</p>
                            <p class="text-lg font-bold text-blue-600 mt-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <p class="text-sm text-gray-600 mt-1">Jumlah: {{ $quantity }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Shipping Address -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Alamat Pengiriman</h2>
                    
                    @if($addresses->count() > 0)
                        <div class="space-y-3 mb-4">
                            @foreach($addresses as $address)
                                <label class="flex items-start space-x-3 p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="address_id" value="{{ $address->id }}" 
                                           {{ $address->is_primary ? 'checked' : '' }}
                                           x-model="showNewAddress" value="false"
                                           class="mt-1 text-blue-600 border-gray-300 focus:ring-blue-500">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-2">
                                            <span class="font-medium text-gray-900">{{ $address->recipient_name }}</span>
                                            @if($address->is_primary)
                                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded">Utama</span>
                                            @endif
                                        </div>
                                        <p class="text-sm text-gray-600">{{ $address->phone }}</p>
                                        <p class="text-sm text-gray-600">{{ $address->full_address }}</p>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    @endif
                    
                    <button type="button" @click="showNewAddress = !showNewAddress" 
                            class="text-blue-600 hover:text-blue-700 text-sm font-medium mb-4">
                        + Tambah Alamat Baru
                    </button>
                    
                    <!-- New Address Form -->
                    <div x-show="showNewAddress" x-transition class="border-t border-gray-200 pt-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="recipient_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Penerima</label>
                                <input type="text" name="new_address[recipient_name]" id="recipient_name" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="Nama lengkap penerima">
                            </div>
                            
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                                <input type="tel" name="new_address[phone]" id="phone" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="081234567890">
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                            <textarea name="new_address[address]" id="address" rows="2" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                      placeholder="Jalan, nomor rumah, RT/RW, kelurahan, kecamatan"></textarea>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                                <input type="text" name="new_address[city]" id="city" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="Nama kota">
                            </div>
                            
                            <div>
                                <label for="province" class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                                <input type="text" name="new_address[province]" id="province" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="Nama provinsi">
                            </div>
                            
                            <div>
                                <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
                                <input type="text" name="new_address[postal_code]" id="postal_code" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="12345">
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <label class="flex items-center">
                                <input type="checkbox" name="new_address[is_primary]" value="1" 
                                       class="text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Jadikan alamat utama</span>
                            </label>
                        </div>
                    </div>
                </div>
                
                <!-- Payment Method -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Metode Pembayaran</h2>
                    
                    <div class="space-y-3">
                        <!-- Balance Payment -->
                        <label class="flex items-center space-x-3 p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50"
                               :class="{ 'border-blue-500 bg-blue-50': paymentMethod === 'balance' }">
                            <input type="radio" name="payment_method" value="balance" 
                                   x-model="paymentMethod" 
                                   class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <span class="font-medium text-gray-900">Saldo Akun</span>
                                    <span class="text-sm font-medium text-green-600">
                                        Rp {{ number_format($userBalance, 0, ',', '.') }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600">Bayar menggunakan saldo di akun Anda</p>
                                
                                <!-- Insufficient balance warning -->
                                <div x-show="userBalance < totalAmount" class="mt-2 p-2 bg-red-50 border border-red-200 rounded text-sm text-red-700">
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>Saldo tidak mencukupi. Silakan pilih metode pembayaran lain atau top up saldo.</span>
                                    </div>
                                </div>
                            </div>
                        </label>
                        
                        <!-- Bank Transfer -->
                        <label class="flex items-center space-x-3 p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50"
                               :class="{ 'border-blue-500 bg-blue-50': paymentMethod === 'bank_transfer' }">
                            <input type="radio" name="payment_method" value="bank_transfer" 
                                   x-model="paymentMethod" 
                                   class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            <div class="flex-1">
                                <span class="font-medium text-gray-900">Transfer Bank</span>
                                <p class="text-sm text-gray-600">Transfer ke rekening bank kami</p>
                            </div>
                        </label>
                        
                        <!-- E-wallet -->
                        <label class="flex items-center space-x-3 p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50"
                               :class="{ 'border-blue-500 bg-blue-50': paymentMethod === 'ewallet' }">
                            <input type="radio" name="payment_method" value="ewallet" 
                                   x-model="paymentMethod" 
                                   class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            <div class="flex-1">
                                <span class="font-medium text-gray-900">E-Wallet</span>
                                <p class="text-sm text-gray-600">GoPay, OVO, DANA, ShopeePay</p>
                            </div>
                        </label>
                        
                        <!-- Credit Card -->
                        <label class="flex items-center space-x-3 p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50"
                               :class="{ 'border-blue-500 bg-blue-50': paymentMethod === 'credit_card' }">
                            <input type="radio" name="payment_method" value="credit_card" 
                                   x-model="paymentMethod" 
                                   class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            <div class="flex-1">
                                <span class="font-medium text-gray-900">Kartu Kredit/Debit</span>
                                <p class="text-sm text-gray-600">Visa, MasterCard, JCB</p>
                            </div>
                        </label>
                    </div>
                </div>
                
                <!-- Additional Notes -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Catatan Pesanan (Opsional)</h2>
                    <textarea name="notes" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                              placeholder="Tambahkan catatan khusus untuk pesanan ini..."></textarea>
                </div>
            </div>
            
            <!-- Order Summary Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 sticky top-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Ringkasan Pesanan</h2>
                    
                    <div class="space-y-3 mb-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Subtotal ({{ $quantity }} item)</span>
                            <span class="text-gray-900">Rp {{ number_format($product->price * $quantity, 0, ',', '.') }}</span>
                        </div>
                        
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Ongkos Kirim</span>
                            <span class="text-gray-900">Rp {{ number_format($shipping_cost ?? 15000, 0, ',', '.') }}</span>
                        </div>
                        
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Biaya Admin</span>
                            <span class="text-gray-900">Rp {{ number_format($admin_fee ?? 2000, 0, ',', '.') }}</span>
                        </div>
                        
                        @if(isset($discount) && $discount > 0)
                        <div class="flex justify-between text-sm text-green-600">
                            <span>Diskon</span>
                            <span>-Rp {{ number_format($discount, 0, ',', '.') }}</span>
                        </div>
                        @endif
                        
                        <div class="border-t border-gray-200 pt-3">
                            <div class="flex justify-between font-semibold text-lg">
                                <span class="text-gray-900">Total</span>
                                <span class="text-blue-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="space-y-3">
                        <button type="submit" 
                                :disabled="paymentMethod === 'balance' && userBalance < totalAmount"
                                :class="{
                                    'bg-gray-400 cursor-not-allowed': paymentMethod === 'balance' && userBalance < totalAmount,
                                    'bg-blue-600 hover:bg-blue-700': !(paymentMethod === 'balance' && userBalance < totalAmount)
                                }"
                                class="w-full py-3 px-4 text-white font-semibold rounded-lg transition duration-200">
                            <span x-show="paymentMethod === 'balance' && userBalance < totalAmount">
                                Saldo Tidak Mencukupi
                            </span>
                            <span x-show="!(paymentMethod === 'balance' && userBalance < totalAmount)">
                                Buat Pesanan
                            </span>
                        </button>
                        
                        <a href="{{ route('products.show', $product) }}" 
                           class="w-full block text-center py-3 px-4 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition duration-200">
                            Kembali ke Produk
                        </a>
                    </div>
                    
                    <!-- Security Notice -->
                    <div class="mt-6 p-3 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-green-800">Transaksi Aman</p>
                                <p class="text-xs text-green-700">Data pribadi Anda dilindungi dengan enkripsi SSL</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Toast Notifications -->
@if(session('success'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
     class="fixed top-4 right-4 z-50 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
     class="fixed top-4 right-4 z-50 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg">
    {{ session('error') }}
</div>
@endif

@if($errors->any())
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 8000)" 
     class="fixed top-4 right-4 z-50 bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg max-w-md">
    <h4 class="font-semibold mb-2">Terjadi kesalahan:</h4>
    <ul class="text-sm space-y-1">
        @foreach($errors->all() as $error)
        <li>• {{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-format phone number
    const phoneInputs = document.querySelectorAll('input[type="tel"]');
    phoneInputs.forEach(input => {
        input.addEventListener('input', function() {
            let value = this.value.replace(/\D/g, '');
            if (value.startsWith('0')) {
                this.value = value;
            } else if (value.startsWith('62')) {
                this.value = '0' + value.substring(2);
            }
        });
    });
    
    // Auto-format postal code
    const postalInput = document.getElementById('postal_code');
    if (postalInput) {
        postalInput.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '').substring(0, 5);
        });
    }
    
    // Form validation before submit
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked');
        if (!paymentMethod) {
            e.preventDefault();
            alert('Silakan pilih metode pembayaran');
            return;
        }
        
        // Check if new address is being used
        const showNewAddress = document.querySelector('[x-data]').__x.$data.showNewAddress;
        if (showNewAddress) {
            const requiredFields = ['recipient_name', 'phone', 'address', 'city', 'province', 'postal_code'];
            const missingFields = [];
            
            requiredFields.forEach(field => {
                const input = document.querySelector(`input[name="new_address[${field}]"], textarea[name="new_address[${field}]"]`);
                if (input && !input.value.trim()) {
                    missingFields.push(field.replace('_', ' '));
                }
            });
            
            if (missingFields.length > 0) {
                e.preventDefault();
                alert(`Harap lengkapi field: ${missingFields.join(', ')}`);
                return;
            }
        } else {
            // Check if existing address is selected
            const selectedAddress = document.querySelector('input[name="address_id"]:checked');
            if (!selectedAddress) {
                e.preventDefault();
                alert('Silakan pilih alamat pengiriman');
                return;
            }
        }
        
        // Show loading state
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="flex items-center justify-center"><svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Memproses...</span>';
        
        // Re-enable button after 10 seconds as fallback
        setTimeout(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        }, 10000);
    });
});
</script>
@endpush
<!-- resources/views/user/payment-methods.blade.php -->
@extends('layouts.app')

@section('title', 'Metode Pembayaran')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Metode Pembayaran</h1>
        <p class="text-gray-600">Kelola metode pembayaran untuk kemudahan berbelanja</p>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Payment Methods List -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-gray-900">Metode Pembayaran Tersimpan</h2>
                        <button onclick="showAddPaymentModal()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm">
                            Tambah Metode
                        </button>
                    </div>
                </div>
                
                <div class="p-6">
                    @if($paymentMethods->count() > 0)
                        <div class="space-y-4">
                            @foreach($paymentMethods as $method)
                                <div class="border border-gray-200 rounded-lg p-4 {{ $method->is_primary ? 'ring-2 ring-blue-500 bg-blue-50' : '' }}">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            <!-- Payment Method Icon -->
                                            <div class="w-12 h-8 bg-gray-100 rounded flex items-center justify-center">
                                                @if($method->type === 'bank_transfer')
                                                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/>
                                                    </svg>
                                                @elseif($method->type === 'e_wallet')
                                                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                                    </svg>
                                                @else
                                                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                                    </svg>
                                                @endif
                                            </div>
                                            
                                            <div>
                                                <div class="flex items-center space-x-2">
                                                    <h3 class="font-semibold text-gray-900">{{ $method->type_display }}</h3>
                                                    @if($method->is_primary)
                                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded-full">Utama</span>
                                                    @endif
                                                    @if($method->is_verified)
                                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded-full">Terverifikasi</span>
                                                    @else
                                                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-1 rounded-full">Menunggu Verifikasi</span>
                                                    @endif
                                                </div>
                                                <p class="text-sm text-gray-600">{{ strtoupper($method->provider) }} - {{ $method->account_name }}</p>
                                                <p class="text-sm text-gray-500">**** **** {{ substr($method->account_number, -4) }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-center space-x-2">
                                            @if(!$method->is_primary)
                                                <form action="{{ route('payment-methods.store') }}" method="POST" class="inline">
                                                    @csrf
                                                    <input type="hidden" name="set_primary" value="{{ $method->id }}">
                                                    <button type="submit" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                                        Jadikan Utama
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            <form action="{{ route('payment-methods.delete', $method->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-700 text-sm font-medium"
                                                        onclick="return confirm('Yakin ingin menghapus metode pembayaran ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada metode pembayaran</h3>
                            <p class="text-gray-600 mb-6">Tambahkan metode pembayaran untuk kemudahan berbelanja</p>
                            <button onclick="showAddPaymentModal()" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                Tambah Metode Pembayaran
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Payment Info Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Info Pembayaran</h3>
                <div class="space-y-4 text-sm text-gray-600">
                    <div class="flex items-start space-x-2">
                        <svg class="w-5 h-5 text-green-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p>Data pembayaran Anda aman dan terenkripsi</p>
                    </div>
                    <div class="flex items-start space-x-2">
                        <svg class="w-5 h-5 text-green-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p>Verifikasi otomatis untuk keamanan tambahan</p>
                    </div>
                    <div class="flex items-start space-x-2">
                        <svg class="w-5 h-5 text-green-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p>Support untuk semua bank dan e-wallet Indonesia</p>
                    </div>
                </div>
            </div>
            
            <!-- Supported Payment Methods -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Metode yang Didukung</h3>
                
                <div class="space-y-4">
                    <div>
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Transfer Bank</h4>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded">BCA</span>
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded">Mandiri</span>
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded">BNI</span>
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded">BRI</span>
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-700 mb-2">E-Wallet</h4>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded">GoPay</span>
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded">OVO</span>
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded">DANA</span>
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded">ShopeePay</span>
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Kartu Kredit</h4>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2 py-1 rounded">Visa</span>
                            <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2 py-1 rounded">Mastercard</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Payment Method Modal -->
<div id="addPaymentModal" class="fixed inset-0 z-50 hidden" style="background-color: rgba(0, 0, 0, 0.5);">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Tambah Metode Pembayaran</h3>
                    <button onclick="closeAddPaymentModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
            
            <form action="{{ route('payment-methods.store') }}" method="POST" class="px-6 py-4">
                @csrf
                
                <div class="space-y-4">
                    <!-- Payment Type -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Jenis Pembayaran</label>
                        <select id="type" name="type" required onchange="updateProviders()" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Pilih jenis pembayaran</option>
                            <option value="bank_transfer">Transfer Bank</option>
                            <option value="e_wallet">E-Wallet</option>
                            <option value="credit_card">Kartu Kredit</option>
                        </select>
                    </div>
                    
                    <!-- Provider -->
                    <div>
                        <label for="provider" class="block text-sm font-medium text-gray-700 mb-2">Penyedia Layanan</label>
                        <select id="provider" name="provider" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Pilih penyedia layanan</option>
                        </select>
                    </div>
                    
                    <!-- Account Name -->
                    <div>
                        <label for="account_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Pemilik Akun</label>
                        <input type="text" id="account_name" name="account_name" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Nama sesuai rekening/akun">
                    </div>
                    
                    <!-- Account Number -->
                    <div>
                        <label for="account_number" class="block text-sm font-medium text-gray-700 mb-2">Nomor Rekening/Akun</label>
                        <input type="text" id="account_number" name="account_number" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Nomor rekening atau nomor akun">
                    </div>
                    
                    <!-- Set as Primary -->
                    <div class="flex items-center">
                        <input type="checkbox" id="is_primary" name="is_primary" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <label for="is_primary" class="ml-2 block text-sm text-gray-900">
                            Jadikan sebagai metode pembayaran utama
                        </label>
                    </div>
                    
                    <!-- Info -->
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                        <div class="flex">
                            <svg class="w-5 h-5 text-yellow-400 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-sm text-yellow-800">
                                Metode pembayaran akan diverifikasi oleh admin sebelum dapat digunakan untuk transaksi.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeAddPaymentModal()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Tambah Metode
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function showAddPaymentModal() {
    document.getElementById('addPaymentModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeAddPaymentModal() {
    document.getElementById('addPaymentModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
    // Reset form
    document.querySelector('#addPaymentModal form').reset();
    updateProviders();
}

function updateProviders() {
    const typeSelect = document.getElementById('type');
    const providerSelect = document.getElementById('provider');
    const accountNumberInput = document.getElementById('account_number');
    
    // Clear providers
    providerSelect.innerHTML = '<option value="">Pilih penyedia layanan</option>';
    
    const providers = {
        'bank_transfer': [
            { value: 'bca', text: 'Bank Central Asia (BCA)' },
            { value: 'mandiri', text: 'Bank Mandiri' },
            { value: 'bni', text: 'Bank Negara Indonesia (BNI)' },
            { value: 'bri', text: 'Bank Rakyat Indonesia (BRI)' },
            { value: 'cimb', text: 'CIMB Niaga' },
            { value: 'danamon', text: 'Bank Danamon' }
        ],
        'e_wallet': [
            { value: 'gopay', text: 'GoPay' },
            { value: 'ovo', text: 'OVO' },
            { value: 'dana', text: 'DANA' },
            { value: 'shopeepay', text: 'ShopeePay' },
            { value: 'linkaja', text: 'LinkAja' }
        ],
        'credit_card': [
            { value: 'visa', text: 'Visa' },
            { value: 'mastercard', text: 'Mastercard' }
        ]
    };
    
    if (typeSelect.value && providers[typeSelect.value]) {
        providers[typeSelect.value].forEach(provider => {
            const option = document.createElement('option');
            option.value = provider.value;
            option.textContent = provider.text;
            providerSelect.appendChild(option);
        });
        
        // Update placeholder
        if (typeSelect.value === 'bank_transfer') {
            accountNumberInput.placeholder = 'Nomor rekening (contoh: 1234567890)';
        } else if (typeSelect.value === 'e_wallet') {
            accountNumberInput.placeholder = 'Nomor handphone (contoh: 081234567890)';
        } else if (typeSelect.value === 'credit_card') {
            accountNumberInput.placeholder = 'Nomor kartu kredit (contoh: 4111-1111-1111-1111)';
        }
    }
}

// Close modal when clicking outside
document.getElementById('addPaymentModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeAddPaymentModal();
    }
});
</script>
@endsection
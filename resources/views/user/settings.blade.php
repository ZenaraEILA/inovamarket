<!-- resources/views/user/settings.blade.php -->
@extends('layouts.app')

@section('title', 'Pengaturan')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Pengaturan</h1>
        <p class="text-gray-600">Kelola preferensi dan pengaturan akun Anda</p>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Settings Navigation -->
        <div class="lg:col-span-1">
            <nav class="space-y-2" x-data="{ activeTab: 'general' }">
                <button @click="activeTab = 'general'" 
                        :class="activeTab === 'general' ? 'bg-blue-50 text-blue-700 border-blue-200' : 'text-gray-700 hover:bg-gray-50'"
                        class="w-full text-left px-4 py-3 rounded-lg border transition-colors">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Umum
                    </div>
                </button>
                
                <button @click="activeTab = 'notifications'" 
                        :class="activeTab === 'notifications' ? 'bg-blue-50 text-blue-700 border-blue-200' : 'text-gray-700 hover:bg-gray-50'"
                        class="w-full text-left px-4 py-3 rounded-lg border transition-colors">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM12 19H6a2 2 0 01-2-2V7a2 2 0 012-2h12a2 2 0 012 2v5M9 9l6 6m0-6L9 15"/>
                        </svg>
                        Notifikasi
                    </div>
                </button>
                
                <button @click="activeTab = 'privacy'" 
                        :class="activeTab === 'privacy' ? 'bg-blue-50 text-blue-700 border-blue-200' : 'text-gray-700 hover:bg-gray-50'"
                        class="w-full text-left px-4 py-3 rounded-lg border transition-colors">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Privasi & Keamanan
                    </div>
                </button>
                
                <button @click="activeTab = 'appearance'" 
                        :class="activeTab === 'appearance' ? 'bg-blue-50 text-blue-700 border-blue-200' : 'text-gray-700 hover:bg-gray-50'"
                        class="w-full text-left px-4 py-3 rounded-lg border transition-colors">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM7 3H5a2 2 0 00-2 2v12a4 4 0 004 4h2a2 2 0 002-2V5a2 2 0 00-2-2z"/>
                        </svg>
                        Tampilan
                    </div>
                </button>
            </nav>
        </div>
        
        <!-- Settings Content -->
        <div class="lg:col-span-3">
            <form action="{{ route('settings.update') }}" method="POST" x-data="{ activeTab: 'general' }">
                @csrf
                @method('PUT')
                
                <!-- General Settings -->
                <div x-show="activeTab === 'general'" class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900">Pengaturan Umum</h2>
                        <p class="text-sm text-gray-600">Atur preferensi dasar akun Anda</p>
                    </div>
                    
                    <div class="p-6 space-y-6">
                        <!-- Language -->
                        <div>
                            <label for="language" class="block text-sm font-medium text-gray-700 mb-2">Bahasa</label>
                            <select id="language" name="language" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="id" {{ old('language', $settings->language ?? 'id') == 'id' ? 'selected' : '' }}>Bahasa Indonesia</option>
                                <option value="en" {{ old('language', $settings->language ?? 'id') == 'en' ? 'selected' : '' }}>English</option>
                            </select>
                        </div>
                        
                        <!-- Currency -->
                        <div>
                            <label for="currency" class="block text-sm font-medium text-gray-700 mb-2">Mata Uang</label>
                            <select id="currency" name="currency" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="IDR" {{ old('currency', $settings->currency ?? 'IDR') == 'IDR' ? 'selected' : '' }}>Rupiah (IDR)</option>
                                <option value="USD" {{ old('currency', $settings->currency ?? 'IDR') == 'USD' ? 'selected' : '' }}>US Dollar (USD)</option>
                            </select>
                        </div>
                        
                        <!-- Timezone -->
                        <div>
                            <label for="timezone" class="block text-sm font-medium text-gray-700 mb-2">Zona Waktu</label>
                            <select id="timezone" name="timezone" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="Asia/Jakarta" {{ old('timezone', $settings->timezone ?? 'Asia/Jakarta') == 'Asia/Jakarta' ? 'selected' : '' }}>WIB - Jakarta</option>
                                <option value="Asia/Makassar" {{ old('timezone', $settings->timezone ?? 'Asia/Jakarta') == 'Asia/Makassar' ? 'selected' : '' }}>WITA - Makassar</option>
                                <option value="Asia/Jayapura" {{ old('timezone', $settings->timezone ?? 'Asia/Jakarta') == 'Asia/Jayapura' ? 'selected' : '' }}>WIT - Jayapura</option>
                            </select>
                        </div>
                        
                        <!-- Auto-save preferences -->
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h3 class="text-sm font-medium text-gray-900 mb-3">Preferensi Otomatis</h3>
                            <div class="space-y-3">
                                <label class="flex items-center">
                                    <input type="checkbox" name="auto_save_cart" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" checked>
                                    <span class="ml-2 text-sm text-gray-700">Simpan keranjang belanja secara otomatis</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="auto_logout" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Logout otomatis setelah 30 menit tidak aktif</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="remember_search" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" checked>
                                    <span class="ml-2 text-sm text-gray-700">Ingat riwayat pencarian</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Notification Settings -->
                <div x-show="activeTab === 'notifications'" class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900">Pengaturan Notifikasi</h2>
                        <p class="text-sm text-gray-600">Kelola bagaimana Anda ingin menerima notifikasi</p>
                    </div>
                    
                    <div class="p-6 space-y-6">
                        <!-- Email Notifications -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Notifikasi Email</h3>
                            <div class="space-y-3">
                                <label class="flex items-center justify-between">
                                    <div>
                                        <span class="text-sm font-medium text-gray-700">Notifikasi Pesanan</span>
                                        <p class="text-sm text-gray-500">Terima email saat status pesanan berubah</p>
                                    </div>
                                    <input type="checkbox" name="order_notifications" value="1" 
                                           {{ old('order_notifications', $settings->order_notifications ?? true) ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                </label>
                                
                                <label class="flex items-center justify-between">
                                    <div>
                                        <span class="text-sm font-medium text-gray-700">Email Marketing</span>
                                        <p class="text-sm text-gray-500">Terima email tentang produk baru dan promosi</p>
                                    </div>
                                    <input type="checkbox" name="marketing_emails" value="1"
                                           {{ old('marketing_emails', $settings->marketing_emails ?? true) ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                </label>
                                
                                <label class="flex items-center justify-between">
                                    <div>
                                        <span class="text-sm font-medium text-gray-700">Alert Keamanan</span>
                                        <p class="text-sm text-gray-500">Notifikasi login dan aktivitas mencurigakan</p>
                                    </div>
                                    <input type="checkbox" name="security_alerts" value="1"
                                           {{ old('security_alerts', $settings->security_alerts ?? true) ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                </label>
                            </div>
                        </div>
                        
                        <!-- Push Notifications -->
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Notifikasi Push</h3>
                            <div class="space-y-3">
                                <label class="flex items-center justify-between">
                                    <div>
                                        <span class="text-sm font-medium text-gray-700">Notifikasi Browser</span>
                                        <p class="text-sm text-gray-500">Tampilkan notifikasi di browser</p>
                                    </div>
                                    <input type="checkbox" name="browser_notifications" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                </label>
                                
                                <label class="flex items-center justify-between">
                                    <div>
                                        <span class="text-sm font-medium text-gray-700">Notifikasi SMS</span>
                                        <p class="text-sm text-gray-500">Terima SMS untuk pesanan penting</p>
                                    </div>
                                    <input type="checkbox" name="sms_notifications" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                </label>
                            </div>
                        </div>
                        
                        <!-- Notification Frequency -->
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Frekuensi Notifikasi</h3>
                            <div>
                                <label for="notification_frequency" class="block text-sm font-medium text-gray-700 mb-2">Ringkasan Email</label>
                                <select id="notification_frequency" name="notification_frequency" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="instant">Segera</option>
                                    <option value="daily" selected>Harian</option>
                                    <option value="weekly">Mingguan</option>
                                    <option value="never">Tidak pernah</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Privacy & Security Settings -->
                <div x-show="activeTab === 'privacy'" class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900">Privasi & Keamanan</h2>
                        <p class="text-sm text-gray-600">Kontrol privasi dan keamanan akun Anda</p>
                    </div>
                    
                    <div class="p-6 space-y-6">
                        <!-- Two Factor Authentication -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Autentikasi Dua Faktor</h3>
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                                <div class="flex">
                                    <svg class="w-5 h-5 text-yellow-400 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.35 15.5c-.77.833.192 2.5 1.732 2.5z"/>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-yellow-800">Fitur dalam pengembangan</p>
                                        <p class="text-sm text-yellow-700 mt-1">2FA akan tersedia dalam update mendatang untuk keamanan tambahan</p>
                                    </div>
                                </div>
                            </div>
                            
                            <label class="flex items-center justify-between">
                                <div>
                                    <span class="text-sm font-medium text-gray-700">Aktifkan 2FA</span>
                                    <p class="text-sm text-gray-500">Tambah lapisan keamanan dengan kode verifikasi</p>
                                </div>
                                <input type="checkbox" name="two_factor_enabled" value="1" disabled class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 opacity-50">
                            </label>
                        </div>
                        
                        <!-- Profile Visibility -->
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Visibilitas Profil</h3>
                            <div>
                                <label for="profile_visibility" class="block text-sm font-medium text-gray-700 mb-2">Siapa yang bisa melihat profil Anda?</label>
                                <select id="profile_visibility" name="profile_visibility" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="public">Semua orang</option>
                                    <option value="friends" selected>Hanya teman</option>
                                    <option value="private">Hanya saya</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Privacy Controls -->
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Kontrol Privasi</h3>
                            <div class="space-y-3">
                                <label class="flex items-center justify-between">
                                    <div>
                                        <span class="text-sm font-medium text-gray-700">Tampilkan Status Online</span>
                                        <p class="text-sm text-gray-500">Orang lain bisa melihat kapan Anda online</p>
                                    </div>
                                    <input type="checkbox" name="show_online_status" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" checked>
                                </label>
                                
                                <label class="flex items-center justify-between">
                                    <div>
                                        <span class="text-sm font-medium text-gray-700">Izinkan Permintaan Teman</span>
                                        <p class="text-sm text-gray-500">Orang lain bisa mengirim permintaan pertemanan</p>
                                    </div>
                                    <input type="checkbox" name="allow_friend_requests" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" checked>
                                </label>
                                
                                <label class="flex items-center justify-between">
                                    <div>
                                        <span class="text-sm font-medium text-gray-700">Tampilkan Riwayat Pembelian</span>
                                        <p class="text-sm text-gray-500">Orang lain bisa melihat produk yang pernah Anda beli</p>
                                    </div>
                                    <input type="checkbox" name="show_purchase_history" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                </label>
                            </div>
                        </div>
                        
                        <!-- Data & Analytics -->
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Data & Analytics</h3>
                            <div class="space-y-3">
                                <label class="flex items-center justify-between">
                                    <div>
                                        <span class="text-sm font-medium text-gray-700">Izinkan Analytics</span>
                                        <p class="text-sm text-gray-500">Bantu kami meningkatkan layanan dengan data anonim</p>
                                    </div>
                                    <input type="checkbox" name="allow_analytics" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" checked>
                                </label>
                                
                                <label class="flex items-center justify-between">
                                    <div>
                                        <span class="text-sm font-medium text-gray-700">Personalisasi Iklan</span>
                                        <p class="text-sm text-gray-500">Tampilkan iklan yang relevan berdasarkan aktivitas</p>
                                    </div>
                                    <input type="checkbox" name="personalized_ads" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Appearance Settings -->
                <div x-show="activeTab === 'appearance'" class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900">Pengaturan Tampilan</h2>
                        <p class="text-sm text-gray-600">Kustomisasi tampilan dan nuansa aplikasi</p>
                    </div>
                    
                    <div class="p-6 space-y-6">
                        <!-- Theme -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Tema</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <label class="relative">
                                    <input type="radio" name="theme" value="light" {{ old('theme', $settings->theme ?? 'light') == 'light' ? 'checked' : '' }} class="sr-only peer">
                                    <div class="border-2 rounded-lg p-4 cursor-pointer transition-colors peer-checked:border-blue-500 peer-checked:bg-blue-50">
                                        <div class="bg-white rounded shadow-sm p-3 mb-2">
                                            <div class="h-2 bg-gray-200 rounded mb-2"></div>
                                            <div class="h-2 bg-gray-100 rounded"></div>
                                        </div>
                                        <p class="text-sm font-medium text-center">Terang</p>
                                    </div>
                                </label>
                                
                                <label class="relative">
                                    <input type="radio" name="theme" value="dark" {{ old('theme', $settings->theme ?? 'light') == 'dark' ? 'checked' : '' }} class="sr-only peer">
                                    <div class="border-2 rounded-lg p-4 cursor-pointer transition-colors peer-checked:border-blue-500 peer-checked:bg-blue-50">
                                        <div class="bg-gray-800 rounded shadow-sm p-3 mb-2">
                                            <div class="h-2 bg-gray-600 rounded mb-2"></div>
                                            <div class="h-2 bg-gray-700 rounded"></div>
                                        </div>
                                        <p class="text-sm font-medium text-center">Gelap</p>
                                    </div>
                                </label>
                                
                                <label class="relative opacity-50">
                                    <input type="radio" name="theme" value="auto" disabled class="sr-only peer">
                                    <div class="border-2 rounded-lg p-4 cursor-not-allowed">
                                        <div class="bg-gradient-to-r from-white to-gray-800 rounded shadow-sm p-3 mb-2">
                                            <div class="h-2 bg-gray-400 rounded mb-2"></div>
                                            <div class="h-2 bg-gray-300 rounded"></div>
                                        </div>
                                        <p class="text-sm font-medium text-center">Otomatis</p>
                                        <p class="text-xs text-gray-500 text-center mt-1">Segera hadir</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Layout Preferences -->
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Preferensi Layout</h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="products_per_page" class="block text-sm font-medium text-gray-700 mb-2">Produk per Halaman</label>
                                    <select id="products_per_page" name="products_per_page" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <option value="12" selected>12 produk</option>
                                        <option value="24">24 produk</option>
                                        <option value="36">36 produk</option>
                                        <option value="48">48 produk</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="default_view" class="block text-sm font-medium text-gray-700 mb-2">Tampilan Default Produk</label>
                                    <select id="default_view" name="default_view" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <option value="grid" selected>Grid</option>
                                        <option value="list">List</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Accessibility -->
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Aksesibilitas</h3>
                            <div class="space-y-3">
                                <label class="flex items-center justify-between">
                                    <div>
                                        <span class="text-sm font-medium text-gray-700">Font Besar</span>
                                        <p class="text-sm text-gray-500">Perbesar ukuran font untuk kemudahan baca</p>
                                    </div>
                                    <input type="checkbox" name="large_font" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                </label>
                                
                                <label class="flex items-center justify-between">
                                    <div>
                                        <span class="text-sm font-medium text-gray-700">Kontras Tinggi</span>
                                        <p class="text-sm text-gray-500">Tingkatkan kontras warna untuk visibilitas</p>
                                    </div>
                                    <input type="checkbox" name="high_contrast" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                </label>
                                
                                <label class="flex items-center justify-between">
                                    <div>
                                        <span class="text-sm font-medium text-gray-700">Animasi Minimal</span>
                                        <p class="text-sm text-gray-500">Kurangi animasi dan transisi</p>
                                    </div>
                                    <input type="checkbox" name="reduced_motion" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Save Button -->
                <div class="mt-8 flex justify-end space-x-4">
                    <a href="{{ route('dashboard') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')

@section('title', 'Tambah Produk')
@section('header', 'Tambah Produk')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Tambah Produk Baru</h2>
        </div>
        
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Produk</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Category -->
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                <select id="category_id" name="category_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('category_id') border-red-500 @enderror">
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea id="description" name="description" rows="4" required
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Price and Stock -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Harga (Rp)</label>
                    <input type="number" id="price" name="price" value="{{ old('price') }}" min="0" step="0.01" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('price') border-red-500 @enderror">
                    @error('price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">Stok</label>
                    <input type="number" id="stock" name="stock" value="{{ old('stock') }}" min="0" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('stock') border-red-500 @enderror">
                    @error('stock')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Image -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Gambar Produk</label>
                <input type="file" id="image" name="image" accept="image/*"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('image') border-red-500 @enderror">
                <p class="mt-1 text-sm text-gray-500">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB.</p>
                @error('image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Status -->
            <div class="flex items-center">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}
                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="is_active" class="ml-2 block text-sm text-gray-900">
                    Produk Aktif
                </label>
            </div>
            
            <!-- Buttons -->
            <div class="flex justify-end space-x-4 pt-4">
                <a href="{{ route('admin.products.index') }}" 
                   class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
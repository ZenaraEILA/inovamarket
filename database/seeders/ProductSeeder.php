<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Kerajinan Tangan
            [
                'name' => 'Tas Rajutan Handmade',
                'description' => 'Tas rajutan unik buatan tangan dengan motif tradisional. Terbuat dari benang berkualitas tinggi dan sangat awet.',
                'price' => 75000,
                'stock' => 10,
                'category_id' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Dompet Kulit Sintetis',
                'description' => 'Dompet praktis dari kulit sintetis dengan design minimalis modern. Cocok untuk pria dan wanita.',
                'price' => 45000,
                'stock' => 15,
                'category_id' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Gelang Manik-manik',
                'description' => 'Gelang cantik dari manik-manik warna-warni dengan kombinasi unik. Tersedia berbagai motif.',
                'price' => 25000,
                'stock' => 25,
                'category_id' => 1,
                'is_active' => true,
            ],

            // Makanan & Minuman
            [
                'name' => 'Kue Brownies Coklat',
                'description' => 'Brownies coklat lembut dan legit dengan topping keju. Dibuat dengan resep rahasia keluarga.',
                'price' => 35000,
                'stock' => 20,
                'category_id' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Jus Buah Segar',
                'description' => 'Jus buah segar tanpa pengawet. Tersedia rasa mangga, jeruk, dan jambu. Dikemas dalam botol 500ml.',
                'price' => 15000,
                'stock' => 30,
                'category_id' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Keripik Pisang Crispy',
                'description' => 'Keripik pisang renyah dengan rasa original dan balado. Cocok untuk cemilan sehat.',
                'price' => 20000,
                'stock' => 50,
                'category_id' => 2,
                'is_active' => true,
            ],

            // Teknologi
            [
                'name' => 'Aplikasi Mobile Kasir',
                'description' => 'Aplikasi kasir sederhana untuk UMKM dengan fitur inventory dan laporan penjualan.',
                'price' => 150000,
                'stock' => 5,
                'category_id' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Website Company Profile',
                'description' => 'Jasa pembuatan website company profile responsive dengan design modern.',
                'price' => 500000,
                'stock' => 3,
                'category_id' => 3,
                'is_active' => true,
            ],

            // Seni & Desain
            [
                'name' => 'Lukisan Abstrak Canvas',
                'description' => 'Lukisan abstrak original di atas canvas ukuran 30x40cm. Cocok untuk dekorasi ruangan.',
                'price' => 125000,
                'stock' => 8,
                'category_id' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Design Logo Bisnis',
                'description' => 'Jasa design logo profesional untuk bisnis Anda. Termasuk 3 konsep design dan revisi unlimited.',
                'price' => 100000,
                'stock' => 10,
                'category_id' => 4,
                'is_active' => true,
            ],

            // Jasa
            [
                'name' => 'Les Privat Matematika',
                'description' => 'Les privat matematika untuk siswa SD-SMP. Berpengalaman dan metode pembelajaran yang mudah dipahami.',
                'price' => 50000,
                'stock' => 20,
                'category_id' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Jasa Fotografi Event',
                'description' => 'Jasa fotografi untuk acara ulang tahun, wisuda, dan event lainnya. Hasil foto HD dan editing profesional.',
                'price' => 300000,
                'stock' => 5,
                'category_id' => 5,
                'is_active' => true,
            ],

            // Fashion
            [
                'name' => 'Kaos Custom Design',
                'description' => 'Kaos dengan design custom sesuai keinginan. Bahan cotton combed 24s yang nyaman dan berkualitas.',
                'price' => 65000,
                'stock' => 40,
                'category_id' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'Topi Baseball Custom',
                'description' => 'Topi baseball dengan bordir nama atau logo custom. Tersedia berbagai warna dan ukuran.',
                'price' => 55000,
                'stock' => 25,
                'category_id' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

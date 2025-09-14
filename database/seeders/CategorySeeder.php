<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Kerajinan Tangan',
                'description' => 'Produk kerajinan tangan buatan siswa seperti tas, dompet, aksesoris'
            ],
            [
                'name' => 'Makanan & Minuman',
                'description' => 'Makanan dan minuman homemade karya siswa'
            ],
            [
                'name' => 'Teknologi',
                'description' => 'Produk teknologi dan aplikasi buatan siswa'
            ],
            [
                'name' => 'Seni & Desain',
                'description' => 'Karya seni, lukisan, dan desain grafis siswa'
            ],
            [
                'name' => 'Jasa',
                'description' => 'Layanan jasa yang ditawarkan siswa seperti les privat, design, dll'
            ],
            [
                'name' => 'Fashion',
                'description' => 'Produk fashion dan aksesoris buatan siswa'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

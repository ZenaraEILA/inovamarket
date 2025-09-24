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
                'name' => 'Alat Tulis',
                'description' => 'Berbagai alat tulis yang dibutuhkan siswa di sekolah seperti pensil, pulpen, penghapus, dll.'
            ],
            [
                'name' => 'Makanan & Minuman',
                'description' => 'Makanan dan minuman yang dijual di sekolah, termasuk cemilan dan minuman segar.'
            ],
            [
                'name' => 'LKS',
                'description' => 'Lembar Kerja Siswa (LKS) dan buku pelajaran yang digunakan di sekolah.'
            ],
            [
                'name' => 'Seragam',
                'description' => 'Seragam sekolah dan atribut pendukung seperti dasi, topi, dan sepatu.'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

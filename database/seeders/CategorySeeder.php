<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Category::insert([
            [
                'name' => 'Filosofía',
                'description' => 'Palabras profundas del pensamiento filosófico',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ciencia',
                'description' => 'Términos complejos del ámbito científico',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Literatura',
                'description' => 'Vocabulario elevado y literario',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Política',
                'description' => 'Palabras sofisticadas del discurso político',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

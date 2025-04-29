<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = \App\Models\Category::pluck('id', 'name');

        \App\Models\Word::insert([
            // Filosofía
            [
                'text' => 'Ontológico',
                'category_id' => $categories['Filosofía'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'text' => 'Epistemología',
                'category_id' => $categories['Filosofía'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'text' => 'Deontología',
                'category_id' => $categories['Filosofía'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Ciencia
            [
                'text' => 'Entropía',
                'category_id' => $categories['Ciencia'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'text' => 'Isótopo',
                'category_id' => $categories['Ciencia'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'text' => 'Cromatografía',
                'category_id' => $categories['Ciencia'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Literatura
            [
                'text' => 'Prosopopeya',
                'category_id' => $categories['Literatura'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'text' => 'Hipérbaton',
                'category_id' => $categories['Literatura'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'text' => 'Paronomasia',
                'category_id' => $categories['Literatura'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Política
            [
                'text' => 'Plutocracia',
                'category_id' => $categories['Política'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'text' => 'Gerrymandering',
                'category_id' => $categories['Política'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'text' => 'Oclocracia',
                'category_id' => $categories['Política'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

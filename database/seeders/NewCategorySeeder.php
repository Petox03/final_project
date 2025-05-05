<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NewCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name'         => 'Arte',
                'description'  => 'Términos refinados del mundo artístico',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'name'         => 'Tecnología',
                'description'  => 'Vocabulario avanzado del ámbito tecnológico',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'name'         => 'Historia',
                'description'  => 'Palabras poco comunes para entender el pasado',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'name'         => 'Música',
                'description'  => 'Términos especializados en teoría y composición musical',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'name'         => 'Gastronomía',
                'description'  => 'Vocabulario único del arte culinario',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'name'         => 'Geografía',
                'description'  => 'Términos sobre la formación y características de la Tierra',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'name'         => 'Psicología',
                'description'  => 'Vocabulario avanzado de las ciencias mentales',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'name'         => 'Arquitectura',
                'description'  => 'Términos sofisticados del diseño y construcción',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'name'         => 'Ecología',
                'description'  => 'Palabras especializadas sobre el medio ambiente y la flora',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'name'         => 'Economía',
                'description'  => 'Términos complejos del ámbito económico y financiero',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
        ]);
    }
}

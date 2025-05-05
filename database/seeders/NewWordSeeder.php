<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NewWordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = DB::table('categories')->pluck('id', 'name');

        DB::table('words')->insert([
            // Categoría: Arte
            [
                'text'         => 'Policromía',
                'category_id'  => $categories['Arte'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'text'         => 'Impasto',
                'category_id'  => $categories['Arte'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'text'         => 'Sfumato',
                'category_id'  => $categories['Arte'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            // Categoría: Tecnología
            [
                'text'         => 'Containerización',
                'category_id'  => $categories['Tecnología'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'text'         => 'Hyperconvergencia',
                'category_id'  => $categories['Tecnología'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'text'         => 'Orquestación',
                'category_id'  => $categories['Tecnología'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            // Categoría: Historia
            [
                'text'         => 'Sincretismo',
                'category_id'  => $categories['Historia'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'text'         => 'Palimpsesto',
                'category_id'  => $categories['Historia'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'text'         => 'Interregno',
                'category_id'  => $categories['Historia'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            // Categoría: Música
            [
                'text'         => 'Contrapunto',
                'category_id'  => $categories['Música'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'text'         => 'Polirritmia',
                'category_id'  => $categories['Música'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'text'         => 'Atonalidad',
                'category_id'  => $categories['Música'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            // Categoría: Gastronomía
            [
                'text'         => 'Umami',
                'category_id'  => $categories['Gastronomía'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'text'         => 'Mirepoix',
                'category_id'  => $categories['Gastronomía'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'text'         => 'Emulsión',
                'category_id'  => $categories['Gastronomía'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            // Categoría: Geografía
            [
                'text'         => 'Istmo',
                'category_id'  => $categories['Geografía'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'text'         => 'Altiplano',
                'category_id'  => $categories['Geografía'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'text'         => 'Orogénesis',
                'category_id'  => $categories['Geografía'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            // Categoría: Psicología
            [
                'text'         => 'Neuroplasticidad',
                'category_id'  => $categories['Psicología'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'text'         => 'Anhedonia',
                'category_id'  => $categories['Psicología'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'text'         => 'Sublimación',
                'category_id'  => $categories['Psicología'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            // Categoría: Arquitectura
            [
                'text'         => 'Acroterio',
                'category_id'  => $categories['Arquitectura'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'text'         => 'Entablamento',
                'category_id'  => $categories['Arquitectura'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'text'         => 'Ménsula',
                'category_id'  => $categories['Arquitectura'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            // Categoría: Ecología
            [
                'text'         => 'Edáfico',
                'category_id'  => $categories['Ecología'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'text'         => 'Xerófilo',
                'category_id'  => $categories['Ecología'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'text'         => 'Paleosuelo',
                'category_id'  => $categories['Ecología'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            // Categoría: Economía
            [
                'text'         => 'Mercantilismo',
                'category_id'  => $categories['Economía'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'text'         => 'Exogeneidad',
                'category_id'  => $categories['Economía'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'text'         => 'Isomorfismo',
                'category_id'  => $categories['Economía'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
        ]);
    }
}

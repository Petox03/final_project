<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $words = \App\Models\Word::pluck('id', 'text');
        $opciones = [
            // Filosofía
            [
                'word' => 'Ontológico',
                'opciones' => [
                    ['text' => 'Relativo al ser o a la existencia', 'is_correct' => true],
                    ['text' => 'Relacionado con la belleza', 'is_correct' => false],
                    ['text' => 'Propio de la vida cotidiana', 'is_correct' => false],
                ],
            ],
            [
                'word' => 'Epistemología',
                'opciones' => [
                    ['text' => 'Estudio del conocimiento', 'is_correct' => true],
                    ['text' => 'Estudio de los números', 'is_correct' => false],
                    ['text' => 'Estudio de la moral', 'is_correct' => false],
                ],
            ],
            [
                'word' => 'Deontología',
                'opciones' => [
                    ['text' => 'Ética profesional', 'is_correct' => true],
                    ['text' => 'Rama de la biología', 'is_correct' => false],
                    ['text' => 'Corriente literaria', 'is_correct' => false],
                ],
            ],
            // Ciencia
            [
                'word' => 'Entropía',
                'opciones' => [
                    ['text' => 'Medida del desorden', 'is_correct' => true],
                    ['text' => 'Tipo de célula', 'is_correct' => false],
                    ['text' => 'Unidad de masa', 'is_correct' => false],
                ],
            ],
            [
                'word' => 'Isótopo',
                'opciones' => [
                    ['text' => 'Átomo con igual número atómico y diferente masa', 'is_correct' => true],
                    ['text' => 'Molécula orgánica compleja', 'is_correct' => false],
                    ['text' => 'Partícula subatómica negativa', 'is_correct' => false],
                ],
            ],
            [
                'word' => 'Cromatografía',
                'opciones' => [
                    ['text' => 'Técnica de separación de mezclas', 'is_correct' => true],
                    ['text' => 'Estudio de los colores', 'is_correct' => false],
                    ['text' => 'Tipo de célula vegetal', 'is_correct' => false],
                ],
            ],
            // Literatura
            [
                'word' => 'Prosopopeya',
                'opciones' => [
                    ['text' => 'Atribuir cualidades humanas a objetos', 'is_correct' => true],
                    ['text' => 'Alteración del orden lógico', 'is_correct' => false],
                    ['text' => 'Repetición de sonidos', 'is_correct' => false],
                ],
            ],
            [
                'word' => 'Hipérbaton',
                'opciones' => [
                    ['text' => 'Alteración del orden lógico de las palabras', 'is_correct' => true],
                    ['text' => 'Figura de acumulación', 'is_correct' => false],
                    ['text' => 'Personificación', 'is_correct' => false],
                ],
            ],
            [
                'word' => 'Paronomasia',
                'opciones' => [
                    ['text' => 'Juego de palabras similares', 'is_correct' => true],
                    ['text' => 'Comparación explícita', 'is_correct' => false],
                    ['text' => 'Exageración literaria', 'is_correct' => false],
                ],
            ],
            // Política
            [
                'word' => 'Plutocracia',
                'opciones' => [
                    ['text' => 'Gobierno de los ricos', 'is_correct' => true],
                    ['text' => 'Gobierno de los sabios', 'is_correct' => false],
                    ['text' => 'Gobierno de las masas', 'is_correct' => false],
                ],
            ],
            [
                'word' => 'Gerrymandering',
                'opciones' => [
                    ['text' => 'Manipulación de distritos electorales', 'is_correct' => true],
                    ['text' => 'Sistema de votación proporcional', 'is_correct' => false],
                    ['text' => 'Reforma constitucional', 'is_correct' => false],
                ],
            ],
            [
                'word' => 'Oclocracia',
                'opciones' => [
                    ['text' => 'Gobierno de la muchedumbre', 'is_correct' => true],
                    ['text' => 'Gobierno de un solo individuo', 'is_correct' => false],
                    ['text' => 'Gobierno militar', 'is_correct' => false],
                ],
            ],
        ];

        $bulk = [];
        foreach ($opciones as $item) {
            $wordId = $words[$item['word']];
            foreach ($item['opciones'] as $op) {
                $bulk[] = [
                    'word_id' => $wordId,
                    'text' => $op['text'],
                    'is_correct' => $op['is_correct'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        \App\Models\Option::insert($bulk);
    }
}

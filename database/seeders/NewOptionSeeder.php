<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NewOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $words = DB::table('words')->pluck('id', 'text');

        $opciones = [
            // Arte
            [
                'word' => 'Policromía',
                'opciones' => [
                    ['text' => 'Uso de varios colores en una obra de arte', 'is_correct' => true],
                    ['text' => 'Técnica de escultura en mármol', 'is_correct' => false],
                    ['text' => 'Estudio del movimiento en danza', 'is_correct' => false],
                ],
            ],
            [
                'word' => 'Impasto',
                'opciones' => [
                    ['text' => 'Aplicación de pintura espesa sobre el lienzo', 'is_correct' => true],
                    ['text' => 'Método para mezclar pigmentos líquidos', 'is_correct' => false],
                    ['text' => 'Técnica de grabado en relieve', 'is_correct' => false],
                ],
            ],
            [
                'word' => 'Sfumato',
                'opciones' => [
                    ['text' => 'Técnica de difuminado que crea transiciones suaves en la pintura', 'is_correct' => true],
                    ['text' => 'Estilo de música barroca', 'is_correct' => false],
                    ['text' => 'Proceso de restauración de esculturas', 'is_correct' => false],
                ],
            ],
            // Tecnología
            [
                'word' => 'Containerización',
                'opciones' => [
                    ['text' => 'Proceso de empaquetar aplicaciones y sus dependencias en contenedores', 'is_correct' => true],
                    ['text' => 'Técnica para diseñar interfaces de usuario', 'is_correct' => false],
                    ['text' => 'Método de virtualización de hardware', 'is_correct' => false],
                ],
            ],
            [
                'word' => 'Hyperconvergencia',
                'opciones' => [
                    ['text' => 'Integración de recursos computacionales, almacenamiento y redes en una solución unificada', 'is_correct' => true],
                    ['text' => 'Sistema operativo especializado para servidores', 'is_correct' => false],
                    ['text' => 'Técnica de programación en tiempo real', 'is_correct' => false],
                ],
            ],
            [
                'word' => 'Orquestación',
                'opciones' => [
                    ['text' => 'Coordinación automatizada de procesos y servicios en entornos tecnológicos', 'is_correct' => true],
                    ['text' => 'Sincronización manual de tareas de programación', 'is_correct' => false],
                    ['text' => 'Técnica para mezclar sonidos digitales', 'is_correct' => false],
                ],
            ],
            // Historia
            [
                'word' => 'Sincretismo',
                'opciones' => [
                    ['text' => 'Combinación de elementos de distintas culturas o religiones', 'is_correct' => true],
                    ['text' => 'Fragmentación de un imperio en pequeños estados', 'is_correct' => false],
                    ['text' => 'Unificación de leyes en un sistema legal único', 'is_correct' => false],
                ],
            ],
            [
                'word' => 'Palimpsesto',
                'opciones' => [
                    ['text' => 'Manuscrito antiguo con textos borrados para reutilizar el soporte', 'is_correct' => true],
                    ['text' => 'Documento legal perdido en la historia', 'is_correct' => false],
                    ['text' => 'Antiguo sistema de mensajería', 'is_correct' => false],
                ],
            ],
            [
                'word' => 'Interregno',
                'opciones' => [
                    ['text' => 'Período sin un gobierno o liderazgo reconocido', 'is_correct' => true],
                    ['text' => 'Tiempo dedicado a celebraciones culturales', 'is_correct' => false],
                    ['text' => 'Método de sucesión hereditaria', 'is_correct' => false],
                ],
            ],
            // Música
            [
                'word' => 'Contrapunto',
                'opciones' => [
                    ['text' => 'Técnica compositiva que combina líneas melódicas independientes', 'is_correct' => true],
                    ['text' => 'Género musical basado en la improvisación', 'is_correct' => false],
                    ['text' => 'Método para afinar instrumentos de cuerda', 'is_correct' => false],
                ],
            ],
            [
                'word' => 'Polirritmia',
                'opciones' => [
                    ['text' => 'Superposición simultánea de ritmos diferentes en una composición', 'is_correct' => true],
                    ['text' => 'Estudio de la evolución de ritmos en la música popular', 'is_correct' => false],
                    ['text' => 'Técnica de reducción de ruidos en grabaciones', 'is_correct' => false],
                ],
            ],
            [
                'word' => 'Atonalidad',
                'opciones' => [
                    ['text' => 'Composición musical sin una tonalidad central definida', 'is_correct' => true],
                    ['text' => 'Estilo vocal sin vibrato', 'is_correct' => false],
                    ['text' => 'Técnica de grabación sin ecualización', 'is_correct' => false],
                ],
            ],
            // Gastronomía
            [
                'word' => 'Umami',
                'opciones' => [
                    ['text' => 'Sabor profundo, uno de los cinco sabores básicos', 'is_correct' => true],
                    ['text' => 'Técnica de cocción a la parrilla', 'is_correct' => false],
                    ['text' => 'Método para enfriar rápidamente alimentos', 'is_correct' => false],
                ],
            ],
            [
                'word' => 'Mirepoix',
                'opciones' => [
                    ['text' => 'Base culinaria de vegetales picados para guisos', 'is_correct' => true],
                    ['text' => 'Técnica de cocción lenta', 'is_correct' => false],
                    ['text' => 'Receta de salsa a base de tomate', 'is_correct' => false],
                ],
            ],
            [
                'word' => 'Emulsión',
                'opciones' => [
                    ['text' => 'Mezcla estable de dos líquidos que normalmente no se combinan', 'is_correct' => true],
                    ['text' => 'Proceso de fermentación de frutas', 'is_correct' => false],
                    ['text' => 'Técnica para separar grasas de proteínas', 'is_correct' => false],
                ],
            ],
            // Geografía
            [
                'word' => 'Istmo',
                'opciones' => [
                    ['text' => 'Franja de tierra estrecha que conecta dos masas continentales', 'is_correct' => true],
                    ['text' => 'Región costera con grandes dunas', 'is_correct' => false],
                    ['text' => 'Conjunto de islas cercanas entre sí', 'is_correct' => false],
                ],
            ],
            [
                'word' => 'Altiplano',
                'opciones' => [
                    ['text' => 'Meseta de gran altitud en el interior de un continente', 'is_correct' => true],
                    ['text' => 'Zona baja y pantanosa', 'is_correct' => false],
                    ['text' => 'Sistema de valles fluviales profundos', 'is_correct' => false],
                ],
            ],
            [
                'word' => 'Orogénesis',
                'opciones' => [
                    ['text' => 'Proceso geológico de formación de montañas', 'is_correct' => true],
                    ['text' => 'Estudio de la erosión costera', 'is_correct' => false],
                    ['text' => 'Método para identificar formaciones rocosas', 'is_correct' => false],
                ],
            ],
            // Psicología
            [
                'word' => 'Neuroplasticidad',
                'opciones' => [
                    ['text' => 'Capacidad del cerebro para cambiar y adaptarse', 'is_correct' => true],
                    ['text' => 'Estado de calma inducido por la meditación', 'is_correct' => false],
                    ['text' => 'Proceso de formación de recuerdos a corto plazo', 'is_correct' => false],
                ],
            ],
            [
                'word' => 'Anhedonia',
                'opciones' => [
                    ['text' => 'Incapacidad para experimentar placer en actividades habituales', 'is_correct' => true],
                    ['text' => 'Exceso de emociones positivas', 'is_correct' => false],
                    ['text' => 'Falta de atención en tareas cotidianas', 'is_correct' => false],
                ],
            ],
            [
                'word' => 'Sublimación',
                'opciones' => [
                    ['text' => 'Proceso de canalizar impulsos inaceptables hacia actividades productivas', 'is_correct' => true],
                    ['text' => 'Método de inhibición de respuestas emocionales', 'is_correct' => false],
                    ['text' => 'Técnica para aumentar la retentiva de información', 'is_correct' => false],
                ],
            ],
            // Arquitectura
            [
                'word' => 'Acroterio',
                'opciones' => [
                    ['text' => 'Elemento ornamental en la parte superior de un edificio', 'is_correct' => true],
                    ['text' => 'Sistema de ventilación natural en construcciones', 'is_correct' => false],
                    ['text' => 'Técnica de aislamiento térmico en muros', 'is_correct' => false],
                ],
            ],
            [
                'word' => 'Entablamento',
                'opciones' => [
                    ['text' => 'Conjunto de elementos situados sobre columnas en la arquitectura clásica', 'is_correct' => true],
                    ['text' => 'Método de distribución de luz natural en interiores', 'is_correct' => false],
                    ['text' => 'Sistema de refuerzo en estructuras de madera', 'is_correct' => false],
                ],
            ],
            [
                'word' => 'Ménsula',
                'opciones' => [
                    ['text' => 'Elemento estructural que sobresale para soportar una carga', 'is_correct' => true],
                    ['text' => 'Técnica decorativa en fachadas modernistas', 'is_correct' => false],
                    ['text' => 'Dispositivo para medir la inclinación de un techo', 'is_correct' => false],
                ],
            ],
            // Ecología
            [
                'word' => 'Edáfico',
                'opciones' => [
                    ['text' => 'Relacionado con el suelo y sus características', 'is_correct' => true],
                    ['text' => 'Técnica para analizar cuerpos de agua', 'is_correct' => false],
                    ['text' => 'Proceso de formación de rocas sedimentarias', 'is_correct' => false],
                ],
            ],
            [
                'word' => 'Xerófilo',
                'opciones' => [
                    ['text' => 'Organismo o planta adaptada a ambientes secos', 'is_correct' => true],
                    ['text' => 'Término para especies acuáticas en climas áridos', 'is_correct' => false],
                    ['text' => 'Método para conservar agua en la agricultura', 'is_correct' => false],
                ],
            ],
            [
                'word' => 'Paleosuelo',
                'opciones' => [
                    ['text' => 'Restos de suelos antiguos que evidencian climas pasados', 'is_correct' => true],
                    ['text' => 'Formación de suelos tras erupciones volcánicas recientes', 'is_correct' => false],
                    ['text' => 'Técnica de análisis de la estructura mineral', 'is_correct' => false],
                ],
            ],
            // Economía
            [
                'word' => 'Mercantilismo',
                'opciones' => [
                    ['text' => 'Sistema económico centrado en la acumulación de metales preciosos y comercio controlado', 'is_correct' => true],
                    ['text' => 'Modelo basado en el libre mercado sin intervención estatal', 'is_correct' => false],
                    ['text' => 'Política de desregulación financiera en épocas modernas', 'is_correct' => false],
                ],
            ],
            [
                'word' => 'Exogeneidad',
                'opciones' => [
                    ['text' => 'Propiedad de una variable que es independiente de los errores en un modelo econométrico', 'is_correct' => true],
                    ['text' => 'Técnica para prever fluctuaciones económicas', 'is_correct' => false],
                    ['text' => 'Concepto de interdependencia entre mercados globales', 'is_correct' => false],
                ],
            ],
            [
                'word' => 'Isomorfismo',
                'opciones' => [
                    ['text' => 'Tendencia de organizaciones a adoptar estructuras similares debido a presiones institucionales', 'is_correct' => true],
                    ['text' => 'Proceso de diversificación en mercados competitivos', 'is_correct' => false],
                    ['text' => 'Método de homologación en la producción industrial', 'is_correct' => false],
                ],
            ],
        ];

        $bulk = [];
        foreach ($opciones as $item) {
            $wordId = $words[$item['word']];
            foreach ($item['opciones'] as $op) {
                $bulk[] = [
                    'word_id'    => $wordId,
                    'text'       => $op['text'],
                    'is_correct' => $op['is_correct'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }
        DB::table('options')->insert($bulk);
    }
}

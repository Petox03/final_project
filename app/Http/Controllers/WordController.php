<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Word;
use App\Models\RegisteredWord;
use App\Models\GameSession;
use App\Models\Category;
use App\Models\Option;
use App\Http\Requests\AnswerMultipleRequest;
use App\Models\WordEventLog;

class WordController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Obtener la palabra diaria para el usuario autenticado.
     */
    public function show(Request $request): JsonResponse
    {
        // Log de consulta de palabras
        $user = $request->user();
        $now = now();
        $user = $request->user();
        $today = now()->toDateString();

        // Verificamos si el usuario ya solicitó palabras hoy.
        /* if (GameSession::where('user_id', $user->id)->where('played_at', $today)->exists()) {
            return response()->json(['message' => 'Ya has solicitado palabras hoy.'], 403);
        } */

        // Lógica original de selección de palabras.
        $categories = $request->input('categories', []);
        $count = (int) $request->input('count', 1);
        $order = $request->input('order', 'asc');
        $order = $order === 'desc' ? 'desc' : 'asc';
        if (empty($categories)) {
            $categories = Category::inRandomOrder()->limit(1)->pluck('id')->toArray();
        }
        $playedIds = RegisteredWord::where('user_id', $user->id)->pluck('word_id')->toArray();

        // Registrar evento de consulta para cada palabra seleccionada
        // (aquí aún no sabemos las palabras, así que se hará después de seleccionarlas)

        $selected = collect();
        foreach ($categories as $cat) {
            $w = Word::with('options')
                ->where('category_id', $cat)
                ->orderBy('id', $order)
                ->whereNotIn('id', $playedIds)
                ->first();
            if ($w) {
                $selected->push($w);
            }
        }
        $needed = max(0, $count - $selected->count());
        if ($needed > 0) {
            $more = Word::with('options')
                ->whereIn('category_id', $categories)
                ->whereNotIn('id', array_merge($playedIds, $selected->pluck('id')->toArray()))
                ->orderBy('id', $order)
                ->limit($needed)
                ->get();
            $selected = $selected->concat($more);
        }
        if ($selected->isEmpty()) {
            return response()->json(['message' => 'No hay palabras disponibles.'], 404);
        }

        // Log de consulta: registrar un evento por cada palabra mostrada
        foreach ($selected->take($count) as $word) {
            WordEventLog::create([
                'user_id' => $user->id,
                'word_id' => $word->id,
                'event_type' => 'consulted',
                'event_at' => now(),
            ]);
        }

        // Se crea la sesión de juego para hoy (se usa null en word_id ya que se entregan varias palabras).
        GameSession::create([
            'user_id'   => $user->id,
            'played_at' => $today,
            'word_id'   => null,
        ]);

        // La respuesta se mantiene igual.
        return response()->json(['words' => $selected->take($count)->values()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Registrar la respuesta del usuario para la palabra diaria.
     */
    public function answer(AnswerMultipleRequest $request): JsonResponse
    {
        // Log de respuesta de palabras
        $user = $request->user();
        $now = now();
        $user = $request->user();
        $today = now()->toDateString();

        // Obtenemos la sesión de juego de hoy.
        $gameSession = GameSession::where('user_id', $user->id)/* ->where('played_at', $today) */->latest()->first();

        if (!$gameSession) {
            return response()->json(['message' => 'No has solicitado palabras hoy.'], 403);
        }

        // Verificamos si el usuario ya respondió.
        /* if ($gameSession->answered_at) {
            return response()->json(['message' => 'Ya has respondido hoy.'], 403);
        } */

        $results = [];
        // Variable para determinar el estado global (opcional).
        $allCorrect = true;
        foreach ($request->input('answers') as $item) {
            $wordId = (int) $item['word_id'];
            $optionId = (int) $item['option_id'];
            $option = Option::query()
                ->where('id', $optionId)
                ->where('word_id', $wordId)
                ->first();
            if (! $option) {
                $results[] = ['word_id' => $wordId, 'correct' => false, 'message' => 'Opción inválida'];
                $allCorrect = false;
                continue;
            }
            // Log de respuesta
            WordEventLog::create([
                'user_id' => $user->id,
                'word_id' => $wordId,
                'event_type' => 'answered',
                'event_at' => now(),
            ]);
            if ($option->is_correct) {
                RegisteredWord::firstOrCreate(['user_id' => $user->id, 'word_id' => $wordId]);
                $results[] = ['word_id' => $wordId, 'correct' => true, 'message' => '¡Respuesta correcta!'];
            } else {
                $results[] = ['word_id' => $wordId, 'correct' => false, 'message' => 'Respuesta incorrecta.'];
                $allCorrect = false;
            }
        }

        // Marcamos la sesión de juego como respondida.
        $gameSession->update([
            'answered_at' => now(),
            'is_correct'  => $allCorrect,
        ]);

        // La estructura de la respuesta se mantiene igual.
        return response()->json(['results' => $results]);
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AnswerMultipleRequest;
use App\Models\Word;
use App\Models\Option;
use App\Models\RegisteredWord;
use App\Models\GameSession;
use Illuminate\Http\JsonResponse;
use App\Models\Category;

class GameController extends Controller
{

    public function categories()
    {
        $categories = Category::all(); // Obtiene todas las categorías de la DB
        return response()->json(['categories' => $categories]);
    }

    /**
     * Obtener la palabra diaria para el usuario autenticado.
     */
    public function words(Request $request): JsonResponse
    {
        $user = $request->user();
        $today = now()->toDateString();

        // Verificamos si el usuario ya solicitó palabras hoy.
        if (GameSession::where('user_id', $user->id)->where('played_at', $today)->exists()) {
            return response()->json(['message' => 'Ya has solicitado palabras hoy.'], 403);
        }

        // Lógica original de selección de palabras.
        $categories = $request->input('categories', []);
        $count = (int) $request->input('count', 1);
        if (empty($categories)) {
            $categories = Category::inRandomOrder()->limit(1)->pluck('id')->toArray();
        }
        $playedIds = RegisteredWord::where('user_id', $user->id)->pluck('word_id')->toArray();
        $selected = collect();
        foreach ($categories as $cat) {
            $w = Word::with('options')
                ->where('category_id', $cat)
                ->whereNotIn('id', $playedIds)
                ->inRandomOrder()
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
                ->inRandomOrder()
                ->limit($needed)
                ->get();
            $selected = $selected->concat($more);
        }
        if ($selected->isEmpty()) {
            return response()->json(['message' => 'No hay palabras disponibles.'], 404);
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
     * Registrar la respuesta del usuario para la palabra diaria.
     */
    public function answer(AnswerMultipleRequest $request): JsonResponse
    {
        $user = $request->user();
        $today = now()->toDateString();

        // Obtenemos la sesión de juego de hoy.
        $gameSession = GameSession::where('user_id', $user->id)->where('played_at', $today)->first();

        if (!$gameSession) {
            return response()->json(['message' => 'No has solicitado palabras hoy.'], 403);
        }

        // Verificamos si el usuario ya respondió.
        if ($gameSession->answered_at) {
            return response()->json(['message' => 'Ya has respondido hoy.'], 403);
        }

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


    /**
     * Historial de palabras jugadas por el usuario.
     */
    public function history(Request $request): JsonResponse
    {
        $user = $request->user();
        $history = RegisteredWord::where('user_id', $user->id)
            ->with('word')
            ->orderByDesc('created_at')
            ->get();
        return response()->json($history);
    }

    /**
     * Progreso y estadísticas del usuario.
     */
    public function progress(Request $request): JsonResponse
    {
        $user = $request->user();
        // Total de palabras acertadas
        $total = RegisteredWord::where('user_id', $user->id)->count();
        // Total de días jugados (sesiones respondidas)
        $days_played = GameSession::where('user_id', $user->id)->whereNotNull('answered_at')->count();
        // Racha actual de aciertos
        $streak = GameSession::where('user_id', $user->id)
            ->whereNotNull('answered_at')
            ->orderByDesc('answered_at')
            ->get()
            ->takeWhile(fn($s) => $s->is_correct)
            ->count();
        return response()->json([
            'total_correct_words' => $total,
            'total_days_played' => $days_played,
            'accuracy' => $days_played > 0 ? round($total * 100 / $days_played, 2) : 0,
            'current_streak' => $streak,
        ]);
    }
}

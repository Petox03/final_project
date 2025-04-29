<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AnswerRequest;
use App\Models\Word;
use App\Models\Option;
use App\Models\RegisteredWord;
use App\Models\GameSession;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class GameController extends Controller
{
    /**
     * Obtener la palabra diaria para el usuario autenticado.
     */
    public function word(Request $request): JsonResponse
    {
        $user = $request->user();
        $today = now()->toDateString();

        $session = GameSession::query()->where('user_id', $user->id)->where('date', $today)->first();
        if ($session) {
            $registered = RegisteredWord::query()->where('user_id', $user->id)->where('game_session_id', $session->id)->with('word.options')->first();
            if ($registered) {
                return response()->json([
                    'word' => $registered->word,
                    'options' => $registered->word->options,
                    'already_played' => true,
                ]);
            }
        }

        $playedWordIds = RegisteredWord::query()->where('user_id', $user->id)->pluck('word_id')->toArray();
        $word = Word::query()->whereNotIn('id', $playedWordIds)->inRandomOrder()->with('options')->first();
        if (! $word) {
            return response()->json([
                'message' => 'No hay más palabras disponibles para jugar.'
            ], 404);
        }

        DB::beginTransaction();
        try {
            $session = GameSession::firstOrCreate([
                'user_id' => $user->id,
                'played_at' => $today,
            ]);
            RegisteredWord::create([
                'user_id' => $user->id,
                'word_id' => $word->id,
                'game_session_id' => $session->id,
            ]);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error al registrar sesión de juego.',
            'error' => $e->getMessage(),
            'session' => $session,
            ], 
            
            500);
        }

        return response()->json([
            'word' => $word,
            'options' => $word->options,
            'already_played' => false,
        ]);
    }

    /**
     * Registrar la respuesta del usuario para la palabra diaria.
     */
    public function answer(AnswerRequest $request): JsonResponse
    {
        $user = $request->user();
        $today = now()->toDateString();
        $session = GameSession::query()->where('user_id', $user->id)->where('date', $today)->first();
        if (! $session) {
            return response()->json(['message' => 'No hay sesión de juego para hoy.'], 400);
        }
        $registered = RegisteredWord::query()->where('user_id', $user->id)->where('game_session_id', $session->id)->first();
        if (! $registered || $registered->word_id !== (int) $request->word_id) {
            return response()->json(['message' => 'La palabra no corresponde a la sesión de hoy.'], 400);
        }
        if ($registered->option_id) {
            return response()->json(['message' => 'Ya has respondido la palabra de hoy.'], 400);
        }
        $option = Option::query()->where('id', $request->option_id)->where('word_id', $request->word_id)->first();
        if (! $option) {
            return response()->json(['message' => 'La opción no corresponde a la palabra.'], 400);
        }
        $registered->option_id = $option->id;
        $registered->is_correct = $option->is_correct;
        $registered->answered_at = now();
        $registered->save();
        return response()->json([
            'correct' => $option->is_correct,
            'message' => $option->is_correct ? '¡Respuesta correcta!' : 'Respuesta incorrecta.',
        ]);
    }

    /**
     * Historial de palabras jugadas por el usuario.
     */
    public function history(Request $request): JsonResponse
    {
        $user = $request->user();
        $history = RegisteredWord::query()
            ->where('user_id', $user->id)
            ->with(['word', 'option'])
            ->orderByDesc('answered_at')
            ->get();
        return response()->json($history);
    }

    /**
     * Progreso y estadísticas del usuario.
     */
    public function progress(Request $request): JsonResponse
    {
        $user = $request->user();
        $total = RegisteredWord::query()->where('user_id', $user->id)->whereNotNull('option_id')->count();
        $correct = RegisteredWord::query()->where('user_id', $user->id)->where('is_correct', true)->count();
        $streak = RegisteredWord::query()
            ->where('user_id', $user->id)
            ->whereNotNull('option_id')
            ->orderByDesc('answered_at')
            ->get()
            ->takeWhile(fn ($r) => $r->is_correct)
            ->count();
        return response()->json([
            'total_played' => $total,
            'correct_answers' => $correct,
            'accuracy' => $total > 0 ? round($correct * 100 / $total, 2) : 0,
            'current_streak' => $streak,
        ]);
    }
}
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

        $session = GameSession::where('user_id', $user->id)->where('played_at', $today)->first();
        if ($session && $session->word_id) {
            $word = Word::with('options')->find($session->word_id);
            return response()->json([
                'word' => $word,
                'options' => $word?->options,
                'already_played' => true,
            ]);
        }

        $playedWordIds = RegisteredWord::where('user_id', $user->id)->pluck('word_id')->toArray();
        $word = Word::whereNotIn('id', $playedWordIds)->inRandomOrder()->with('options')->first();
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
            $session->word_id = $word->id;
            $session->save();
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error al registrar sesión de juego.'], 500);
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
        $session = GameSession::where('user_id', $user->id)->where('played_at', $today)->first();
        if (! $session || ! $session->word_id) {
            return response()->json(['message' => 'No hay palabra asignada para hoy.'], 404);
        }
        if ($session->answered_at) {
            return response()->json(['message' => 'Ya has respondido la palabra de hoy.'], 403);
        }
        if ($session->word_id !== (int)$request->word_id) {
            return response()->json(['message' => 'La palabra no corresponde a la sesión de hoy.'], 409);
        }
        $option = Option::where('id', $request->option_id)->where('word_id', $request->word_id)->first();
        if (! $option) {
            return response()->json(['message' => 'La opción no corresponde a la palabra.'], 422);
        }
        $session->answered_at = now();
        $session->is_correct = $option->is_correct;
        $session->save();
        if ($option->is_correct) {
            RegisteredWord::create([
                'user_id' => $user->id,
                'word_id' => $session->word_id,
            ]);
        }
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
            ->takeWhile(fn ($s) => $s->is_correct)
            ->count();
        return response()->json([
            'total_correct_words' => $total,
            'total_days_played' => $days_played,
            'accuracy' => $days_played > 0 ? round($total * 100 / $days_played, 2) : 0,
            'current_streak' => $streak,
        ]);
    }
}
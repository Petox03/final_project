<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\RegisteredWord;
use App\Models\GameSession;

class RegisteredWordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
}

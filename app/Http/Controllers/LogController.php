<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\WordEventLog;

class LogController extends Controller
{
    /**
     * Obtener los logs de eventos de palabras del usuario autenticado.
     */
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        $logs = WordEventLog::with(['word'])
            ->where('user_id', $user->id)
            ->orderByDesc('event_at')
            ->get();
        return response()->json(['logs' => $logs]);
    }
}

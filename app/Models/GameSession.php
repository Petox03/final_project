<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GameSession extends Model
{
    protected $fillable = [
        'user_id',
        'played_at',
        'word_id',
        'answered_at',
        'is_correct',
    ];

    /**
     * Relación: una sesión de juego pertenece a un usuario.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: una sesión de juego tiene una palabra.
     */
    public function word(): BelongsTo
    {
        return $this->belongsTo(Word::class);
    }
}

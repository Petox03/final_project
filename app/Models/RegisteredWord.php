<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegisteredWord extends Model
{
    protected $fillable = [
        'user_id',
        'word_id',
    ];

    /**
     * Relación: registro pertenece a un usuario.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: registro pertenece a una palabra.
     */
    public function word(): BelongsTo
    {
        return $this->belongsTo(Word::class);
    }
}

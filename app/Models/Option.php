<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Option extends Model
{
    protected $fillable = [
        'word_id',
        'text',
        'is_correct',
    ];

    /**
     * Relación: una opción pertenece a una palabra.
     */
    public function word(): BelongsTo
    {
        return $this->belongsTo(Word::class);
    }
}

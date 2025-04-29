<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * Relación: una categoría tiene muchas palabras.
     */
    public function words(): HasMany
    {
        return $this->hasMany(Word::class);
    }
}

<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Word extends Model
{
    protected $fillable = [
        'text',
        'category_id',
    ];

    /**
     * Relación: una palabra pertenece a una categoría.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relación: una palabra tiene muchas opciones.
     */
    public function options(): HasMany
    {
        return $this->hasMany(Option::class);
    }
}

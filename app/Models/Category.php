<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'position',
        'name_it',
        'name_en',
        'name_de',
        'name_es',
        'name_fr',
    ];

    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }

    /**
     * Attributo "name" che restituisce il nome nella lingua corrente,
     * con fallback all'italiano se la traduzione non è presente.
     */
    public function getNameAttribute(): string
    {
        $locale = app()->getLocale() ?? 'it';
        $column = 'name_' . $locale;

        if (!empty($this->{$column})) {
            return $this->{$column};
        }

        return $this->name_it;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'position',
        'price',
        'is_active',
        'name_it',
        'name_en',
        'name_de',
        'name_es',
        'name_fr',
        'description_it',
        'description_en',
        'description_de',
        'description_es',
        'description_fr',
    ];

    protected $casts = [
        'price'     => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getNameAttribute(): string
    {
        $locale = app()->getLocale();
        $column = 'name_' . $locale;

        if (!empty($this->{$column})) {
            return $this->{$column};
        }

        return $this->name_it ?? '';
    }

    public function getDescriptionAttribute(): ?string
    {
        $locale = app()->getLocale();
        $column = 'description_' . $locale;

        if (!empty($this->{$column})) {
            return $this->{$column};
        }

        return $this->description_it ?: null;
    }

    public function getFormattedPriceAttribute(): ?string
    {
        if ($this->price === null) {
            return null;
        }

        // Formato europeo: 12,50
        return number_format((float) $this->price, 2, ',', ' ');
    }
}

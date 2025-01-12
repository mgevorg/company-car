<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ComfortCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }

    public function positions(): BelongsToMany
    {
        return $this->belongsToMany(Position::class, 'position_comfort_category', 'comfort_category_id', 'position_id');
    }
}

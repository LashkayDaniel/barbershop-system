<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    public $fillable = ['name', 'description'];


    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['price', 'duration']);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}

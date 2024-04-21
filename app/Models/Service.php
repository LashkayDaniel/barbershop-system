<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function discount(): HasOne
    {
        $todayDate = Carbon::today()->toDateString();
        return $this->hasOne(Discount::class)
            ->whereDate('start', '<=', $todayDate)
            ->whereDate('end', '>=', $todayDate);
    }
}

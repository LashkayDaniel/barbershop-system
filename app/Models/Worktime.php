<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worktime extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function isReserved()
    {
        return $this->hasOne(Order::class)->exists();
    }
}

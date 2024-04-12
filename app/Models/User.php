<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'birth',
        'phone',
        'rank',
        'description',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class)
            ->withPivot(['price', 'duration']);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function portfolio(): HasMany
    {
        return $this->hasMany(Portfolio::class);
    }

    public function responses(): HasMany
    {
        return $this->hasMany(Response::class);
    }

    public function worktimes()
    {
        return $this->hasMany(Worktime::class);
    }

    public function isAdmin(): bool
    {
        return $this->role_id == Role::IS_ADMIN;
    }

    public function isEmployee(): bool
    {
        return $this->role_id == Role::IS_EMPLOYEE;
    }

    public function availableWorktimes()
    {
        return $this
            ->worktimes()
            ->whereDate('date', '>=', now()->toDateString())
            ->where('is_free', true)
            ->orderBy('date')
            ->orderBy('time');
    }

    public function getRedirectRoute()
    {
        return match ((int)$this->role_id) {
            Role::IS_ADMIN => '/a/dashboard',
            Role::IS_EMPLOYEE => '/e/dashboard',
        };
    }
}

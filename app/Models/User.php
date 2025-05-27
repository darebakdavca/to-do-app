<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function comments(): HasMany {
        return $this->hasMany(Comment::class);
    }

    public function tasks(): BelongsToMany {
        return $this->belongsToMany(Task::class)->withTimestamps();
    }

    public function ownedTaskLists(): HasMany {
        return $this->hasMany(TaskList::class);
    }

    public function taskLists(): BelongsToMany {
        return $this->belongsToMany(TaskList::class)->withTimestamps();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskList extends Model {
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'type',
        'user_id'
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function users() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function owner(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function tasks(): HasMany {
        return $this->hasMany(Task::class);
    }

    public function invitations(): HasMany {
        return $this->hasMany(Invitation::class);
    }
}

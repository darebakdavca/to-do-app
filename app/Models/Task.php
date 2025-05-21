<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Task extends Model {
    use HasFactory;

    protected $fillable = [
        'task_list_id',
        'name',
        'description',
        'due_date',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function comments(): HasMany {
        return $this->hasMany(Comment::class);
    }

    public function taskList(): BelongsTo {
        return $this->belongsTo(TaskList::class);
    }

    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}

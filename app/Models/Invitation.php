<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invitation extends Model {
    use HasFactory;

    protected $fillable = [
        'email',
        'task_list_id',
        'token',
        'accepted_at',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function taskList(): BelongsTo {
        return $this->belongsTo(TaskList::class);
    }
}

<?php

namespace Modules\Projects\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Projects\Database\Factories\TaskFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'task_name',
        'task_status',
        'task_finish_date',
        'project_id',
    ];

    protected $casts = [
        'task_finish_date' => 'datetime',
    ];

    protected static function newFactory(): TaskFactory
    {
        return TaskFactory::new();
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function getIsOverdueAttribute(): bool
    {
        if (!$this->task_finish_date) {
            return false;
        }
        
        return $this->task_finish_date->isPast() && $this->task_status != 'completed';
    }
}

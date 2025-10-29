<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    protected $table = 'tasks';
    use SoftDeletes;
    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',
    ];

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'Pendiente',
            'completed' => 'Completada',
            default => ucfirst($this->status),
        };
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

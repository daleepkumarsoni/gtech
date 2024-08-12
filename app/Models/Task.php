<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'name',
        'description',
        'status',
        'assigned_to',
        'priority',
        'due_date',
        'created_by',
    ];

    public function project()
    {
        return $this->belongsTo(project::class, 'project_id');
    }
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

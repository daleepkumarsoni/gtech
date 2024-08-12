<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'created_by', // If you're manually assigning this field
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    public function task()
    {
        return $this->hasMany(Task::class, 'created_by');
    }
}

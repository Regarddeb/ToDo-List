<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = 'tasks';
    protected $primaryKey = 'task_id';

    protected $fillable = ['title', 'date', 'time', 'description', 'starred', 'done', 'user_id', 'list_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function taskList()
    {
        return $this->belongsTo(Lists::class, 'list_id');
    }
    
}

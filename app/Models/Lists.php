<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    use HasFactory;
    protected $table = 'lists';
    protected $primaryKey = 'list_id';

    protected $fillable = ['name', 'user_id'];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'list_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); 
    }
}

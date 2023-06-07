<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable= ['cat_id','title','description','start','end', 'user_id' ,'status'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    
    public function subtasks()
    {
        return $this->hasMany(Subtask::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'finished', 'date_due', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

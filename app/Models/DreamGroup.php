<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DreamGroup extends Model
{
    use HasFactory;
    public function user() 
    {
        return $this->belongsTo(User::class);
    }
    public function idols()
    {
        return $this->belongsToMany(Idol::class, 'dream_group_idol');
    }
}

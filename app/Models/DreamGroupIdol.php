<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DreamGroupIdol extends Model
{
    use HasFactory;
    protected $table = 'dream_group_idol';
    protected $fillable = ['idol_id', 'dream_group_id'];
}

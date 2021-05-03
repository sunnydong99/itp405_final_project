<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idol extends Model
{
    use HasFactory;
    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }
    public function company() 
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    public function user() 
    {
        return $this->belongsTo(User::class);
    }
    public function favorites() 
    {
        return $this->hasMany(Favorite::class);
    }
    public function dreamGroups()
    {
        return $this->belongsToMany(DreamGroup::class, 'dream_group_idol');
    }
}

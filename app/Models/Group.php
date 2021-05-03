<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    public function idols()
    {
        return $this->hasMany(Idol::class, 'group_id');
    }
    public function company() {
        return $this->belongsTo(Company::class, 'company_id');
    }
    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}

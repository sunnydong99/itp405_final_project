<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function idols()
    {
        return $this->hasMany(Idol::class);
    }
    public function groups()
    {
        return $this->hasMany(Group::class);
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    public function dreamGroups()
    {
        return $this->hasMany(Favorite::class);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function isAdmin()
    {
        return ($this->role->slug === 'admin');
    }

}
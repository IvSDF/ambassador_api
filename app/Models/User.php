<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use  Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'is_admin',
        'password',
        'password_confirm',
    ];

    protected $hidden = [
        'password',
    ];

    public function scopeAmbassadors($query)
    {
        return $query->where('is_admin', 0);
    }

    public function scopeAdmin($query)
    {
        return $query->where('admin', 0);
    }
}

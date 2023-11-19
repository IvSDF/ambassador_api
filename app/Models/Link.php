<?php

namespace App\Models;

use App\Http\Controllers\LinkController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'user_id'
    ];

    public function  user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, LinkProduct::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'code', 'code')
            ->where('complete', 1);
    }
}

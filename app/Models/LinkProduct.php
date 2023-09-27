<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkProduct extends Model
{
    use HasFactory;

    protected $table = 'link_product';

    protected $guarded = [];
    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    protected $fillable = [
        'nav_name',
        'route_name',
        'icon',
        'order',
        'is_active',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dropdown extends Model
{
    protected $fillable = [
        'option_name',
        'order',
    ];
}

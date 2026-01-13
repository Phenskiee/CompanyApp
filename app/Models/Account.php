<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected  $fillable = [
        'company_site',
        'email_use',
        'password',
        'links',
    ];
}

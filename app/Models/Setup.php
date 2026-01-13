<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setup extends Model
{
    use HasFactory;
    protected $fillable = [
        'setup_name',
        'order',
    ];

    public function companyInfos() {
        return $this->hasMany(CompanyInfo::class);
    }
}

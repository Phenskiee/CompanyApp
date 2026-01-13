<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_name',
        'position',
        'email',
        'salary',
        'company_link',
        'location',
        'platform_id',
        'setup_id',
        'job_description',
    ];
    public function platform() {
        return $this->belongsTo(Platform::class);
    }

    public function setup() {
        return $this->belongsTo(Setup::class);
    }

    public function responses()
    {
        return $this->hasMany(CompanyResponse::class);
    }
}

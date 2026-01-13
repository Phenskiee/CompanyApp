<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyResponse extends Model
{
    protected $fillable = [
        'company_info_id',
        'status_id',
        'application_date',
        'date_of_interview',
        'time_of_interview',
        'status_after_interview_id',
    ];

    public function company()
    {
        return $this->belongsTo(CompanyInfo::class, 'company_info_id');
    }
    public function status()
    {
        return $this->belongsTo(Dropdown::class, 'status_id');
    }

    public function statusAfterInterview()
    {
        return $this->belongsTo(Dropdown::class, 'status_after_interview_id');
    }
}

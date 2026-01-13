<?php

namespace App\Repositories;

use App\Models\Dropdown;
use App\Models\Platform;
use App\Models\Setup;
use App\Models\PersonalInfo;
use App\Models\CompanyInfo;
use App\Models\CompanyResponse;

class AppRepository
{
    public function dashboard() {
        $companies = CompanyInfo::count();
        $applications = CompanyResponse::count();
        $statuses = Dropdown::pluck('id', 'option_name');

        $statusCounts = CompanyResponse::select('status_id')
            ->selectRaw('count(*) as total')
            ->groupBy('status_id')
            ->pluck('total', 'status_id');

        return [
            'companies' => $companies,
            'applications' => $applications,

            'pending'   => $statusCounts[$statuses['Pending'] ?? -1] ?? 0,
            'viewed'    => $statusCounts[$statuses['Viewed'] ?? -1] ?? 0,
            'interview' => $statusCounts[$statuses['For Interview'] ?? -1] ?? 0,
            'rejected'  => $statusCounts[$statuses['Rejected'] ?? -1] ?? 0,
            'jobOffer'  => $statusCounts[$statuses['Job Offer'] ?? -1] ?? 0,

            'afterInterviewPending' =>
                $statusCounts[$statuses['After Interview (Pending)'] ?? -1] ?? 0,

            'afterInterviewRejected' =>
                $statusCounts[$statuses['After Interview (Rejected)'] ?? -1] ?? 0,
        ];
    }

    public function dropDownStatus() {
        $dropdownList = Dropdown::orderBy('order')
            ->select([
                'id',
                'option_name as name',
            ])
            ->get();
        
        return $dropdownList;
    }

    public function dropDownPlatform() {
        $platform = Platform::orderBy('order')
            ->select([
                'id',
                'platform_name as name'
            ])
            ->get();

        return $platform;
    }

    public function dropDownSetup() {
        $setup = Setup::orderBy('order')
            ->select([
                'id',
                'setup_name as name',
            ])
            ->get();
        
        return $setup;
    }

    public function personalInfo() {
        $personalInfo = PersonalInfo::select(
            'name', 
            'email', 
            'phone_number', 
            'address', 
            'portfolio', 
            'introduction'
        )->first();

        return $personalInfo;
    }
}
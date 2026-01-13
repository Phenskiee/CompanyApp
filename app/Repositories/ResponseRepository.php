<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\CompanyResponse;
use App\Models\CompanyInfo;
use Carbon\Carbon;

class ResponseRepository
{
    private function filterResponse($search = null, $status = null) {
        $query = CompanyResponse::with('company', 'status');

        if (!empty($search)) {
            $query->whereHas('company', function($q) use ($search) {
                $q->where('company_name', 'like', "%{$search}%");
            });
        }

        if (!empty($status) && $status != 1) {
            $query->where('status_id', $status);
        }

        return $query;
    }

    public function response(Request $request) {
        $search = $request->get('search', '');
        $status = $request->get('status_id', null);

        $lists = $this->filterResponse($search, $status)
            ->orderBy('id', 'desc')
            ->paginate(8);

        $headers = [
            'Company',
            'Position',
            'Status',
            'Date of Interview',
            'Application Date',
            '',
        ];

        $rows = $lists->map(function($resp) {
             $dateOfInterview = $resp->date_of_interview 
                ? Carbon::parse($resp->date_of_interview)->format('M d, Y') 
                : '';

            $applicationDate = $resp->application_date 
                ? Carbon::parse($resp->application_date)->format('M d, Y') 
                : '';

            return [
                $resp->company->company_name ?? '',
                $resp->company->position ?? '',
                $resp->status->option_name ?? '',
                $dateOfInterview,
                $applicationDate,
                [
                    'ellipsis' => true,
                    'menuItems' => [
                        ['label' => 'Edit', 'action' => 'edit', 'id' => $resp->id],
                        ['label' => 'View', 'action' => 'view', 'id' => $resp->id],
                    ],
                ],
            ];
        })->toArray();

        return [
            'headers' => $headers,
            'rows' => $rows,
            'pagination' => [
                'current_page' => $lists->currentPage(),
                'last_page'    => $lists->lastPage(),
                'per_page'     => $lists->perPage(),
                'total'        => $lists->total(),
            ], 
        ];
    }

    public function showResponse($id) {
        $resp = CompanyResponse::with(['company', 'status'])->findOrFail($id);

        return [
            'id' => $resp->id,
            'company_name' => $resp->company->company_name ?? '',
            'position' => $resp->company->position ?? '',
            'email' => $resp->company->email ?? '',
            'location' => $resp->company->location ?? '',
            'salary' => $resp->company->salary ?? '',
            'company_link' => $resp->company->company_link ?? '',
            'platform_id' => $resp->company->platform_id ?? null,
            'setup_id' => $resp->company->setup_id ?? null,
            'job_description' => $resp->company->job_description ?? '',
            'status_id' => $resp->status_id,
            'status_after_interview_id' => $resp->status_after_interview_id,
            'date_of_interview' => $resp->date_of_interview,

            'application_date' => $resp->application_date
                ? Carbon::parse($resp->application_date)->format('M d, Y')
                : '',

            'application_date_format' => $resp->application_date
                ? Carbon::parse($resp->application_date)->format('M d, Y - l')
                : '',


            'date_of_interview_format' => $resp->date_of_interview
                ? Carbon::parse($resp->date_of_interview)->format('M d, Y - l')
                : '',

            'time_of_interview' => $resp->time_of_interview
                ? Carbon::parse($resp->time_of_interview)->format('H:i')
                : '',

            'time_of_interview_format' => $resp->time_of_interview
                ? Carbon::parse($resp->time_of_interview)->format('h:i A')
                : '',
        ];
    }

    public function responseUpdate($id, array $data) {
        $response = CompanyResponse::with('company')->findOrFail($id);
        $response->update($data);

        return $response;
    }
}
<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\CompanyInfo;
use App\Models\CompanyResponse;

class CompanyRepository
{
    private function filterCompany($search) {
        $query = CompanyInfo::query();

        if(!empty($search)) {
            $query->where('company_name', 'like', "%{$search}%");
        }

        return $query;
    }

    public function company(Request $request) {
        $query = $request->get('search', '');

        $company = $this->filterCompany($query)
            ->with(['platform', 'setup'])
            ->orderBy('id', 'desc')
            ->paginate(8);

        $headers = [
            'Company',
            'Position',
            'Location',
            'Setup',
            'platform',
            '',
        ];

        $rows = $company->map(function($list) {
            return [
                $list->company_name ?? '',
                $list->position ?? '',
                $list->location ?? '',
                $list->setup->setup_name ?? '',
                $list->platform->platform_name ?? '',
                [
                    'ellipsis' => true,
                    'menuItems' => [
                        ['label' => 'Apply', 'action' => 'apply', 'id' => $list->id],
                        ['label' => 'Edit', 'action' => 'edit', 'id' => $list->id],
                        ['label' => 'Delete', 'action' => 'delete', 'id' => $list->id],
                    ],
                ],
            ];
        })->toArray();

        return [
            'headers' => $headers,
            'rows' => $rows,
            'pagination' => [
                'current_page' => $company->currentPage(),
                'last_page'    => $company->lastPage(),
                'per_page'     => $company->perPage(),
                'total'        => $company->total(),
            ],
        ];
    }

    public function companyStore(array $data) {
        $company = CompanyInfo::create($data);

        return $company;
    }

    public function companyUpdate(int $id, array $data) {
        $company = companyInfo::findOrFail($id);
        $company->update($data);

        return $company;
    }

    public function companyDestroy(int $id) {
        $company = companyInfo::findOrFail($id);
        $company->delete();

        return $company;
    }

    public function companyShow($id) {
        $company = CompanyInfo::with(['platform', 'setup'])->findOrFail($id);

        return $company;
    }

    public function addApplication(int $companyId) {
        $company = CompanyInfo::findOrFail($companyId);
        $exists = CompanyResponse::where('company_info_id', $companyId)->exists();

        if ($exists) {
            throw new \Exception("You have already submitted an application to {$company->company_name}.");
        }

        return CompanyResponse::create([
            'company_info_id' => $companyId,
            'application_date' => now(),
        ]);
    }
}
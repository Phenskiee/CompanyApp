<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use Illuminate\Http\Request;
use App\Repositories\CompanyRepository;

class CompanyListController extends Controller
{   
    public function __construct(protected CompanyRepository $app) {}

    private function successResponse($data, string $message, int $status = 200) {
        return response()->json([
            'data' => $data,
            'message' => $message,
        ], $status);
    }
    private function errorResponse($data, string $message, int $status = 500) {
        return response()->json([
            'data' => $data,
            'message' => $message,
        ], $status);
    }

    public function companyList(Request $request) {
        $company = $this->app->company($request);
        
        return response()->json($company, 200);
    }

    public function store(CompanyRequest $request) {
        $validated = $request->validated();
        $dataStore = $this->app->companyStore($validated);

        return $this->successResponse(
            $dataStore,
            "{$dataStore->company_name} Added Successfully!"
        );
    }

    public function update(CompanyRequest $request, $id) {
        $validated = $request->validated();
        $dataUpdate = $this->app->companyUpdate($id, $validated);

        return $this->successResponse(
            $dataUpdate,
            "{$dataUpdate->company_name} Updated Successfully!"
        );
    }
    public function destroy($id) {
        $dataDelete = $this->app->companyDestroy($id);

        return $this->successResponse(
            $dataDelete,
            "{$dataDelete->company_name} has been Deleted!"
        );
    }

    public function show($id){
        $dataShow = $this->app->companyShow($id);

        return response()->json($dataShow);
    }

    public function apply(Request $request) {
        $request->validate([
            'company_id' => 'required|exists:company_infos,id',
        ]);

        try {
            $dataApply = $this->app->addApplication($request->company_id);

            return $this->successResponse(
                $dataApply,
                "Application submitted successfully to {$dataApply->company->company_name}"
            );
        } catch (\Exception $e) {
            return $this->errorResponse(null, $e->getMessage(), 422);
        }
    }
}
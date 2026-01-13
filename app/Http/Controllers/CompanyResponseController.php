<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResponseRequest;
use Illuminate\Http\Request;
use App\Models\CompanyResponse;
use Carbon\Carbon;
use App\Models\CompanyInfo;
use App\Models\Dropdown;
use App\Repositories\ResponseRepository;

class CompanyResponseController extends Controller
{
    public function __construct(protected ResponseRepository $app) {}
    private function successResponse($data, string $message = '', int $status = 200)
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
        ], $status);
    }

    public function companyResponse(Request $request) {
        $dataResponse = $this->app->response($request);

        return response()->json($dataResponse);
    }
    public function show($id) {
        $response = $this->app->showResponse($id);

        return response()->json($response);
    }


    public function update(ResponseRequest $request, $id) {
        $validated = $request->validated();

        $response = CompanyResponse::with('company')->findOrFail($id);
        $response->update($validated);

        return $this->successResponse(
            $response, 
            "{$response->company->company_name} successfully Update!!");
    }
}
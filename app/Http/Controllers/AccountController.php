<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use Illuminate\Http\Request;
use App\Repositories\AccountRepository;

class AccountController extends Controller
{
    public function __construct(protected AccountRepository $account) {}

    private function successResponse($data, string $message, int $status = 200) {
        return response()->json([
            'data' => $data,
            'message' => $message,
        ], $status);
    }
    public function accounts(Request $request) {
        $account = $this->account->addAccount($request);

        return response()->json($account);
    }
    public function store(AccountRequest $request)
    {
        $validated = $request->validated();
        $dataStore = $this->account->accountStore($validated);

        return $this->successResponse(
            $dataStore,
            "{$dataStore->company_site} Added Successfully!",
        );
    }
    public function update(AccountRequest $request, $id)
    {
        $validated = $request->validated();

        $dataUpdate = $this->account->accountUPdate($id, $validated);

        return $this->successResponse(
            $dataUpdate,
            "{$dataUpdate->company_site} Updated Successfully!",
        );
    }

    public function destroy($id) {
        $dataDelete = $this->account->accountDelete($id);

        return $this->successResponse(
            $dataDelete,
            "{$dataDelete->company_site} has been Deleted!",
        );
    }
}
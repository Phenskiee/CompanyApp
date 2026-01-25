<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Account;

class AccountRepository
{
    private function filterAccounts($search) {
        $query = Account::query();

        if(!empty($search)) {
            $query->where('company_site', 'like', "%{$search}%");
        }

        return $query;
    }

    public function addAccount(Request $request) {
        $query = $request->get('search', '');
        $accounts = $this->filterAccounts($query)->orderBy('id', 'desc')->paginate(8);

        $headers = [
            'Company',
            'Email',
            'Password',
            'Links',
            '',
        ];

        $rows = $accounts->map(function($account) {
            return [
                $account->company_site ?? '',
                $account->email_use ?? '',
                $account->password ?? '',
                $account->links ?? '',
                [
                    'ellipsis' => true,
                    'menuItems' => [
                        ['label' => 'Edit', 'action' => 'edit', 'id' => $account->id],
                        ['label' => 'Delete', 'action' => 'delete', 'id' => $account->id],
                    ],
                ],
            ];
        })->toArray();

        return [
            'headers' => $headers,
            'rows' => $rows,
            'pagination' => [
                'current_page' => $accounts->currentPage(),
                'last_page'    => $accounts->lastPage(),
                'per_page'     => $accounts->perPage(),
                'total'        => $accounts->total(),
            ],
        ];
    }

    public function accountStore(array $data) {
        $account = Account::create($data);
        return $account;
    }

    public function accountUPdate($id, array $data) {
        $account = Account::findOrFail($id);
        $account->update($data);
        return $account;
    }

    public function accountDelete($id) {
        $account = Account::findOrFail($id);
        $account->delete();
        return $account;
    }
}
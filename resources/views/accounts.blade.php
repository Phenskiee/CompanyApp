{{-- SEARCH AND ADD BTN SECTION --}}
<div class="company-search-add-dropdown">
    <x-search 
        id="accountSearch"
        table="accounts-table"
        route="{{ route('account.table') }}"
    />
    <x-addBtn 
        addLabel="Add Account"
        addId="open-account-modal"
    />
</div>

{{-- TABLE SECTION --}}
<div class="table-container">
    <x-table
        id="accounts-table"
        route="{{ route('account.table') }}"
    />
     <x-pagination for="accounts-table" />
</div>

{{-- MODAL SECTION --}}
<x-modal 
    label="Add Company Account" 
    modalClass="account-modal"
>
    <x-input type="hidden" name="id" />
    <x-input 
        label="Companies" 
        id="accountCompany" 
        name="company_site" 
    />
    <x-input 
        label="Email" 
        name="email_use" id="emailUse" 
        placeholder="Enter email" 
    />
    <x-input 
        label="Password" 
        name="password" 
        id="accPassword"
        placeholder="Enter password"
    />
    <x-input
        label="Links" 
        name="links" 
        id="accountLinks"
        placeholder="Paste links"
    />
</x-modal>

{{-- @include('scripts.modal-script') --}}
@include('scripts.search-scripts')
{{-- @include('scripts.crud-scripts') --}}

@push('js')
    <script>
        initCrud({
            tableId: 'accounts-table',
            modalClass: 'account-modal',
            routes: {
                table: "{{ route('account.table') }}",
                store: "{{ route('account.store') }}",
                update: "account/update",
                delete: "/account/delete",
                // show: "/account/table",
            },
            fields: {
                company_site: 0,
                email_use: 1,
                password: 2,
                links: 3
            }
        });
        </script>
@endpush
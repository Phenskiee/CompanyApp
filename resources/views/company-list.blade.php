{{-- SEARCH AND ADD BTN SECTION --}}
<div class="company-search-add-dropdown">
    <x-search 
        id="companySearch"
        table="company-table"
        route="{{ route('company.table') }}"
    />
    <x-addBtn addId="open-add-modal" />
</div>

{{-- TABLE SECTION --}}
<div class="table-container">
    <x-table 
        id="company-table"
        {{-- route="{{ route('company.table') }}" --}}
    />
    <x-pagination for="company-table"/>
</div>

{{-- MODAL SECTION --}}
<x-modal modalClass="add-modal">
    <x-input type="hidden" name="id" />
    <x-modal-input>
        <x-input 
            label="Companies" 
            id="companies"
            name="company_name"
        />
        <x-input 
            label="Location" 
            placeholder="Enter Location" 
            name="location"
        />
    </x-modal-input>

    <x-modal-input>
        <x-input 
            label="Email" 
            id="companyEmail"
            name="email"
            placeholder="Enter Email" 
        />
        <x-dropdown
            {{-- name="platform" --}}
            {{-- id="dropdownPlatform" --}}
            label="Platform"
            placeholder="Select Platform"
            name="platform_id"
            route="{{ route('dropdown.platform') }}"
        />
    </x-modal-input>

    <x-modal-input>
        <x-input 
            label="Position" 
            id="add-role"
            name="position"
            placeholder="Enter Position/Role" 
        />
        <x-dropdown
            label="Setup"
            placeholder="Select Setup"
            name="setup_id"
            route="{{ route('dropdown.setup') }}"
        />
    </x-modal-input>
    
    <x-modal-input>
        <x-input 
            label="Salary"
            id="add-salary"
            name="salary"
            placeholder="Enter salary" 
        />
        <x-input 
            label="Links" 
            id="add-links"
            name="company_link"
            placeholder="Paste Link" 
        />
    </x-modal-input>
    
    <x-modal-input>
        <x-text-area
            label="Job Description"
            name="job_description"
        />
    </x-modal-input>
    
</x-modal>

{{-- @include('scripts.modal-script') --}}
@include('scripts.search-scripts')
{{-- @include('scripts.crud-scripts') --}}
@include('scripts.apply-scripts')

@push('js')
    <script>
        initCrud({
            tableId: 'company-table',
            modalClass: 'add-modal',
            routes: {
                table: "{{ route('company.table') }}",
                store: "{{ route('company.store') }}",
                update: "/company/update",
                delete: "/company/delete",
                show: "/company/show",
            },
            fields: {
                company_name: null,
                email: null,
                position: null,
                location: null,
                salary: null,
                platform_id: null,
                setup_id: null,
                company_link: null,
                job_description: null
            },
            reloadTables: ['response-table']
        });
    </script>
@endpush
<div class="company-search-add-dropdown">
    <x-search 
        className="search"
        id="responseSearch"
        table="response-table"
        route="{{ route('response.table') }}"
    />
    <x-dropdown
        dropdownClass="dropdowns"
        id="responseStatusFilter"
        name="status_id"
        route="{{ route('dropdown.list') }}"
    />
</div>
<div class="table-container">
    <x-table
        id="response-table"
    />
    <x-pagination for="response-table" />
</div>

<x-modal modalClass="response-edit-modal">
    <x-input type="hidden" name="id" />
    <x-input
        label="Application Date"
        id="responseApplicationDate"
        name="application_date"
        :readonly="true"
    />
    <x-dropdown
        label="Status"
        id="dropdown"
        name="status_id"
        route="{{ route('dropdown.list') }}"
    />
    <x-input 
        label="Date of Interview"
        type="date"
        id="dateInterview"
        name="date_of_interview"
        placeholder="Select Date" 
    />
    <x-input 
        label="Time of Interview"
        type="time"
        id="timeInterview"
        name="time_of_interview"
        placeholder="Select Time"
    />
</x-modal>
{{-- VIEW --}}
<x-modal 
    modalClass="response-view-modal"
    modalContent="view-content"
    :icon="true"
    :buttons="false"
>
    <x-modal-input>
        <x-input
            label="Email"
            id="responseEmail"
            name="email"
            type="email"
            placeholder="Enter Email"
            :readonly="true"
        />
        <x-input 
            label="Position" 
            id="role"
            name="position"
            placeholder="Enter Position/Role" 
            :readonly="true"
        />
        <x-input
            label="Location"
            id="responseLocation"
            name="location"
            :readonly="true"
        />
        <x-input
            label="Application Date"
            id="applicationDate"
            name="application_date_format"
            :readonly="true"
        />
    </x-modal-input>

    <x-modal-input>
        <x-input 
            label="Salary"
            id="salary"
            name="salary"
            placeholder="Enter salary"
            :readonly="true"
        />
        <x-input 
            label="Links" 
            id="links"
            name="company_link"
            placeholder="Paste Link"
            :readonly="true" 
        />
        <x-dropdown
            label="Platform"
            placeholder="Select Platform"
            name="platform_id"
            route="{{ route('dropdown.platform') }}"
            :disabled="true"
        />
        <x-dropdown
            label="Setup"
            placeholder="Select Setup"
            name="setup_id"
            route="{{ route('dropdown.setup') }}"
            :disabled="true"
        />
    </x-modal-input>

    <x-modal-input>
        <x-dropdown
            label="Status"
            id="dropdown"
            name="status_id"
            route="{{ route('dropdown.list') }}"
            :disabled="true"
        />
        <x-input 
            label="Date of Interview" 
            type="text"
            id="dateInterview"
            name="date_of_interview_format"
            placeholder="Select Date"
            :readonly="true"
        />
        <x-input 
            label="Time of Interview"
            type="text"
            id="timeInterview"
            name="time_of_interview_format"
            placeholder="Select Time"
            :readonly="true"
        />
    </x-modal-input>

    <x-text-area
        label="Job Description"
        classArea="areaText"
        name="job_description"
        :readonly="true"
    />

</x-modal>

@include('scripts.search-scripts')

@push('js')
<script>
    const getResponseFields = () => ({
        company_name: null,
        email: null,
        position: null,
        location: null,
        salary: null,
        company_link: null,
        platform_id: null,
        setup_id: null,
        job_description: null,
        status_id: null,
        status_after_interview_id: null,
        application_date: null,
        application_date_format: null,
        date_of_interview: null,
        date_of_interview_format: null,
        time_of_interview: null,
        time_of_interview_format: null,
    });

    initCrud({
        tableId: 'response-table',
        modalClass: 'response-edit-modal',
        routes: {
            table: "{{ route('response.table') }}",
            store: null,
            update: "/response/update", 
            delete: null,
            show: "/response/show"
        },
        fields: getResponseFields(),
    });
    // VIEW
    initCrud({
        tableId: 'response-view-table',
        modalClass: 'response-view-modal',
        routes: {
            table: "{{ route('response.table') }}",
            store: null,
            update: null,
            delete: null,
            show: "/response/show"
        },
        fields: getResponseFields(),
    });
    </script>
@endpush
<x-index-layout>
    <x-sidebar />
    
    <x-main-container>
        {{-- DASHBOARD SECTION --}}
        <x-section-container 
            mainClass="dashboard-section"
        >
            @include('dashboard')
        </x-section-container>
        
        {{-- COMPANY LIST --}}
        <x-section-container
            header="Companies"
            mainClass="companies-section"
        >
            @include('company-list')
        </x-section-container>

        {{-- RESPONSED SECTION --}}
        <x-section-container
            header="Company Response"
            mainClass="responses-section"
        >
             @include('responses')
        </x-section-container>

        {{-- ACCOUNT LIST --}}
        <x-section-container
            header="Accounts"
            mainClass="accounts-section"
        >
            @include('accounts')
        </x-section-container>

    </x-main-container>

    {{-- Scripts --}}
    @include('scripts.app-scripts')
</x-index-layout>
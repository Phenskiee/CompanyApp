@props([
    'id' => 'dynamic-table', 
    'route' => null
])

<div class="table-wrap">
    <table id="{{ $id }}">
        <thead>
            {{-- Table header --}}
        </thead>
        <tbody>
            {{-- table row --}}
        </tbody>
    </table>
</div>
@include('scripts.table-pagination-scripts')
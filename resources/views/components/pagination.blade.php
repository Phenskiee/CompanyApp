@props([
    'for' => null
])

<div class="pagination" data-table="{{ $for }}">
    <button class="prev">Prev</button>
    <div class="pages"></div>
    <button class="next">Next</button>
</div>
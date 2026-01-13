@props([
    'id' => null,
    'className' => '',
    'placholder' => "Search Companies",
    'table' => null,
    'route' => null,
])

<div class="search-container">
    <input 
        type="text"
        class="{{ $className }}" 
        placeholder="{{ $placholder }}"
        data-table="{{ $table }}"
        data-route="{{ $route }}"
    >
    <button 
        class="clearBtn" 
        type="button"
        data-table="{{ $table }}"
        data-route="{{ $route }}"
    >
        <i class="fa-solid fa-eraser"></i>
    </button>
</div>
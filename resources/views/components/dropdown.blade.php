@props([
    'placeholder' => 'Select status',
    'dropdownClass' => 'dropdown',
    'label' => '',
    'id' => null,
    'name' => '',
    'route',
    'disabled' => false,
    // 'dataValue',
    // 'dataText',
])
<div class="{{ $dropdownClass }}">
    <span>{{ $label }}</span>
    <select 
        id="{{ $id }}"
        name="{{ $name }}"
        class="getDropdown"
        data-route="{{ $route }}"
        @disabled($disabled)
    >
        <option value="" disabled selected>{{ $placeholder }}</option>
    </select>
</div>
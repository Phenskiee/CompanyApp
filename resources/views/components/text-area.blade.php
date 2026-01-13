@props([
    'label' => '',
    'classArea' => '',
    'placeholder' => "Add Description",
    'textInput' => '',
    'readonly' => false,
    'route' => null,
    'name' => '',
])
<div class="description-container">
    <span>{{ $label }}</span>
    <textarea
        class="{{ $classArea }}"
        name="{{ $name }}"
        @readonly($readonly)
        cols="30" 
        rows="6" 
        placeholder="{{ $placeholder }}"
        data-route="{{ $route }}"
    >{{ $textInput }}</textarea>
</div>
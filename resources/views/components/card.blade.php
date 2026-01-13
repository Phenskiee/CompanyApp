@props([
    'counter' => 0,
    'label',
    'id' => null,
])
<div class="card" id="{{ $id }}">
    <div class="counter">{{ $counter }}</div>
    <div class="card-label"> {{ $label }}</div>
</div>
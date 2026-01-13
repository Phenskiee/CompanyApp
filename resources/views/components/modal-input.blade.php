@props([
    'modalInputClass' => 'modal-input-container',
])
<div class="{{ $modalInputClass }}">
    {{ $slot }}
</div>
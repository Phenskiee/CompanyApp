@props([
    'label' => 'Add Application',
    'modalClass' => null,
    'buttons' => true,
    'icon' => false,
    'modalContent' => '',
])
<div 
    class="modal-container {{ $modalClass }}">
    <div class="modal-content {{ $modalContent }}">
        <div class="modal-header">
            <span id="modalHeader">{{ $label }}</span>
            @if($icon)
                <i id="close" class="fa-solid fa-xmark"></i>
            @endif
        </div>
        
        {{ $slot }}
        
        @if($buttons)
            <x-addbtn
                addLabel="Save"
                :cancel="true"
                cancelId="close"
            />
        @endif
    </div>
</div>
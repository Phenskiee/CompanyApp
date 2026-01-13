@props([
    'addId' => null,
    'cancelId' => null,
    'type' => 'button',
    'addLabel' => "Add Company",
    'cancelLabel' => "Cancel",
    'btnClass' => 'btn-container',
    'cancel' => false,
    'ellipsis' => false,
    'menuItems' => [],
])

<div class="{{ $btnClass }}">
    @if ($cancel)
        <button 
            id="{{ $cancelId }}"
            class="cancelBtn" 
            type="{{ $type }}"
        >
            {{ $cancelLabel }}
        </button>
    @endif

    <button 
        id="{{ $addId }}"
        class="addBtn" 
        type="{{ $type }}"
    >
        {{ $addLabel }}
    </button>

    @if($ellipsis)
        <div class="ellipsis-dropdown">
            <button class="ellipsis-btn" type="button">
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </button>
            <div class="ellipsis-menu">
                @foreach ($menuItems as $item)
                    <button 
                        class="ellipsis-item {{ $item['action'] ?? '' }}Btn"
                        data-id="{{ $item['id'] ?? '' }}"
                        type="button"
                    >
                        {{ $item['label'] }}
                    </button>
                @endforeach
            </div>
        </div>
    @endif
</div>
@props([
    'label' => '',
    'id' => '',
    'name' => '',
    'type' => 'text',
    'value' => '',
    'placeholder' => "Enter Companies",
    'readonly' => false,
    'route' => null,
])
<div class="input-container">
    <span>{{ $label }}</span>
    <input 
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $id }}"
        value="{{ $value }}"
        placeholder="{{ $placeholder }}" 
        @readonly($readonly)
        data-route="{{ $route }}"
        data-type="{{ $type }}"
    >
</div>
@push('js')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $(document).ready(function() {
            $('.custom-input').each(function() {
                let type = $(this).data('type');

                if(type === 'date') {
                    flatpickr(this, {
                        dateFormat: 'Y-m-d',
                        altInput: true,
                        altFormat: 'M d, Y',
                        allowInput: true
                    });
                }

                if(type === 'time') {
                    flatpickr(this, {
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: 'H:i',
                        time_24hr: false,
                        allowInput: true
                    });
                }
            });
        });
    </script>
@endpush
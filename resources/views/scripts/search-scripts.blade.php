@push('js')
    <script>
        $(document).ready(function() {

            function performSearch(input) {
                let query = $(input).val();
                let tableId = $(input).data('table');
                let route = $(input).data('route');

                if(!tableId || !route) return;

                loadTable(tableId, route, 1, true, query, getStatusFilter());
            }

            function getStatusFilter() {
                let dropdown = $('#responseStatusFilter');
                return dropdown.length ? dropdown.val() : null;
            }

            $(document).on('change', '#responseStatusFilter', function() {
                const tableId = $(this).closest('.company-search-add-dropdown').find('.search').data('table');
                const route = $(this).closest('.company-search-add-dropdown').find('.search').data('route');
                const searchVal = $(this).closest('.company-search-add-dropdown').find('.search').val();
                let statusVal = $(this).val();

                loadTable(tableId, route, 1, true, searchVal, statusVal);
            });

            $(document).on('input', '.search-container input', function() {
                const tableId = $(this).data('table');
                const route = $(this).data('route');
                const searchVal = $(this).val();
                const statusVal = $('#dropdown').val();
                loadTable(tableId, route, 1, true, searchVal, statusVal);
            });

            $(document).on('click', '.clearBtn', function() {
                let input = $(this).siblings('input')[0];
                if (input) {
                    $(input).val('');
                    performSearch(input);
                }
            });
        });
    </script>
@endpush
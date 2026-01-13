@push('js')
<script>
$(document).ready(function () {
    function loadTable(tableId, route, page = 1) {
        $.ajax({
            url: route,
            method: 'GET',
            data: { page: page },
            dataType: 'json',
            success: function (data) {

                // Table body
                let tbody = '';
                if (data.rows.length) {
                    data.rows.forEach(row => {
                        tbody += '<tr>';
                        row.forEach(cell => tbody += `<td>${cell}</td>`);
                        tbody += '</tr>';
                    });
                } else {
                    tbody = `<tr>
                        <td colspan="${data.headers.length}" class="text-center">
                            No data available
                        </td>
                    </tr>`;
                }
                $('#' + tableId + ' tbody').html(tbody);

                // Pagination
                let pagination = $('.pagination[data-table="' + tableId + '"]');
                let pagesHtml = '';
                let current = data.pagination.current_page;
                let last = data.pagination.last_page;

                // Determine start and end page for window (3 pages max)
                let windowSize = 3;
                let startPage = Math.max(current - 1, 1);
                let endPage = Math.min(startPage + windowSize - 1, last);

                // Adjust startPage if near the end
                if (endPage - startPage + 1 < windowSize) {
                    startPage = Math.max(endPage - windowSize + 1, 1);
                }

                // Build page buttons
                for (let i = startPage; i <= endPage; i++) {
                    pagesHtml += `<button class="page ${i === current ? 'active' : ''}" data-page="${i}">${i}</button>`;
                }

                pagination.find('.pages').html(pagesHtml);

                // Prev / Next
                pagination.find('.prev').prop('disabled', current === 1);
                pagination.find('.next').prop('disabled', current === last);

                pagination.data({
                    table: tableId,
                    route: route,
                    page: current
                });

            },
            error: function () {
                alert('Failed to load table data.');
            }
        });
    }

    // Initial load
    loadTable('accounts-table', "{{ route('account.table') }}");

    /* ---------- PAGINATION EVENTS ---------- */
    $(document).on('click', '.pagination .page', function () {
        let pagination = $(this).closest('.pagination');
        loadTable(pagination.data('table'), pagination.data('route'), $(this).data('page'));
    });
    $(document).on('click', '.pagination .prev', function () {
        let pagination = $(this).closest('.pagination');
        let current = pagination.data('page');
        if (current > 1) loadTable(pagination.data('table'), pagination.data('route'), current - 1);
    });
    $(document).on('click', '.pagination .next', function () {
        let pagination = $(this).closest('.pagination');
        let current = pagination.data('page');
        loadTable(pagination.data('table'), pagination.data('route'), current + 1);
    });

    /* ---------- ADD / UPDATE ---------- */
    $('.account-modal .addBtn').click(function () {
        let id = $('input[name="id"]').val();

        let data = {
            company_site: $('input[name="company_site"]').val(),
            email_use: $('input[name="email_use"]').val(),
            password: $('input[name="password"]').val(),
            links: $('input[name="links"]').val(),
        };

        let url = id ? `/account/table/${id}` : "{{ route('account.store') }}";
        let method = id ? 'PUT' : 'POST';

        $.ajax({
            url: url,
            method: method,
            data: data,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function () {
                $('.account-modal').hide();
                $('.account-modal input').val('');
                $('.account-modal .addBtn').text('Save');

                loadTable('accounts-table', "{{ route('account.table') }}");
            },
            error: function () {
                alert(id ? 'Failed to update account.' : 'Failed to add account.');
            }
        });
    });

    /* ---------- EDIT ---------- */
    $(document).on('click', '.editBtn', function () {
        let row = $(this).closest('tr');
        $('input[name="id"]').val($(this).data('id'));
        $('input[name="company_site"]').val(row.find('td').eq(0).text());
        $('input[name="email_use"]').val(row.find('td').eq(1).text());
        $('input[name="password"]').val(row.find('td').eq(2).text());
        $('input[name="links"]').val(row.find('td').eq(3).text());

        $('.account-modal').css('display','flex');
        $('.account-modal .addBtn').text('Update');
    });

    /* ---------- DELETE ---------- */
    $(document).on('click', '.deleteBtn', function () {
        let id = $(this).data('id');
        if (!confirm('Are you sure you want to delete this account?')) return;

        $.ajax({
            url: `/account/table/${id}`,
            method: 'DELETE',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function () {
                loadTable('accounts-table', "{{ route('account.table') }}");
            },
            error: function () {
                alert('Failed to delete account.');
            }
        });
    });

});
</script>
@endpush

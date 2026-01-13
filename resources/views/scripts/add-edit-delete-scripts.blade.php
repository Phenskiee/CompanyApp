@push('js')
    <script>
        // add-edit-delete-scripts.blade.php
        $(document).ready(function () {

    // ---------- ADD / UPDATE ----------
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
        let actionText = id ? 'updated' : 'added';

        $.ajax({
            url: url,
            method: method,
            data: data,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function () {
                $('.account-modal').hide();
                $('.account-modal input').val('');
                $('.account-modal .addBtn').text('Save');

                // Reload table on current page
                let pagination = $('.pagination[data-table="accounts-table"]');
                let currentPage = pagination.data('page') || 1;
                loadTable('accounts-table', "{{ route('account.table') }}", currentPage);

                // SweetAlert notification
                if(id) {
                    Swal.fire('Updated!', `${data.company_site} successfully updated.`, 'success');
                } else {
                    Swal.fire('Added!', `${data.company_site} added successfully.`, 'success');
                }
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: `Failed to ${id ? 'update' : 'add'} account.`,
                    text: 'Please check your input.'
                });
            }
        });
    });

    // ---------- EDIT ----------
    $(document).on('click', '.editBtn', function () {
        let row = $(this).closest('tr');
        $('input[name="id"]').val($(this).data('id'));
        $('input[name="company_site"]').val(row.find('td').eq(0).text());
        $('input[name="email_use"]').val(row.find('td').eq(1).text());
        $('input[name="password"]').val(row.find('td').eq(2).text());
        $('input[name="links"]').val(row.find('td').eq(3).text());
        
        $('.account-modal .modal-header span').text(`Edit: ${row.find('td').eq(0).text()}`);
        $('.account-modal').css('display','flex');
        $('.account-modal .addBtn').text('Update');
    });

    // ---------- DELETE ----------
    $(document).on('click', '.deleteBtn', function () {
        let id = $(this).data('id');
        let row = $(this).closest('tr');
        let companyName = row.find('td').eq(0).text();

        Swal.fire({
            title: 'Are you sure?',
            text: `You want to delete ${companyName}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#003566',
            cancelButtonColor: '#777c6d',
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/account/table/${id}`,
                    method: 'DELETE',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function () {
                        let pagination = $('.pagination[data-table="accounts-table"]');
                        let currentPage = pagination.data('page') || 1;
                        loadTable('accounts-table', "{{ route('account.table') }}", currentPage);

                        Swal.fire('Deleted!', `${companyName} has been deleted.`, 'success');
                    },
                    error: function () {
                        Swal.fire('Error', 'Failed to delete account.', 'error');
                    }
                });
            }
        });
    });

});
    </script>
@endpush
@push('js')
    <script>
        // add-edit-delete-scripts.blade.php
        $(document).ready(function () {

            // ---------- ADD / UPDATE ----------
            $('.add-modal .addBtn').click(function () {
                let id = $('input[name="id"]').val();
                let data = {
                    company_name: $('input[name="company_name"]').val(),
                    email: $('input[name="email"]').val(),
                    location: $('input[name="location"]').val(),
                    platform: $('input[name="platform"]').val(),
                    position: $('input[name="position"]').val(),
                    setup: $('input[name="setup"]').val(),
                    salary: $('input[name="salary"]').val(),
                    job_descrption: $('input[name="job_descrption"]').val(),
                };

                let url = id ? `/company/table/${id}` : "{{ route('company.store') }}";
                let method = id ? 'PUT' : 'POST';
                let actionText = id ? 'updated' : 'added';

                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function () {
                        $('.add-modal').hide();
                        $('.add-modal input').val('');
                        $('.add-modal .addBtn').text('Save');

                        // Reload table on current page
                        let pagination = $('.pagination[data-table="company-table"]');
                        let currentPage = pagination.data('page') || 1;
                        loadTable('company-table', "{{ route('company.table') }}", currentPage);

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
                            title: `Failed to ${id ? 'update' : 'add'} company.`,
                            text: 'Please check your input.'
                        });
                    }
                });
            });

            // ---------- EDIT ----------
            $(document).on('click', '.editBtn', function () {
                let row = $(this).closest('tr');
                $('input[name="id"]').val($(this).data('id'));
                $('input[name="company_name"]').val(row.find('td').eq(0).text());
                $('input[name="email"]').val(row.find('td').eq(1).text());
                $('input[name="location"]').val(row.find('td').eq(2).text());
                $('input[name="platform"]').val(row.find('td').eq(3).text());
                $('input[name="position"]').val(row.find('td').eq(4).text());
                $('input[name="setup"]').val(row.find('td').eq(5).text());
                $('input[name="salary"]').val(row.find('td').eq(6).text());
                $('input[name="job_description"]').val(row.find('td').eq(7).text());

                $('.add-modal .modal-header span').text(`Edit: ${row.find('td').eq(0).text()}`);

                $('.add-modal').css('display','flex');
                $('.add-modal .addBtn').text('Update');
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
                            url: `/company/table/${id}`,
                            method: 'DELETE',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            success: function () {
                                let pagination = $('.pagination[data-table="company-table"]');
                                let currentPage = pagination.data('page') || 1;
                                loadTable('company-table', "{{ route('company.table') }}", currentPage);

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
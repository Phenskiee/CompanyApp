@push('js')
    <script>
        $(document).on('click', '.applyBtn', function () {
            const companyId = $(this).data('id');

            const row = $(this).closest('tr');
            const companyName = row.find('td').eq(0).text().trim();

            Swal.fire({
                title: 'Send Application',
                html: `Apply to the <strong>${companyName}</strong>?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Apply',
                cancelButtonText: 'Cancel'
            }).then((result) => {

                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('response.apply') }}",
                        method: 'POST',
                        data: {
                            company_id: companyId
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function () {

                            Swal.fire({
                                title: 'Application Send',
                                html: `Succesfully apply to <strong>${companyName}</strong>.`,
                                icon: 'success'
                            });

                            updateDashboardCounters();
                        
                            loadTable('response-table', "{{ route('response.table') }}", 1, true);
                        },
                        error: function (xhr) {

                            let message = 'Something went wrong.';

                            if (xhr.responseJSON?.message) {
                                // message = xhr.responseJSON.message;
                                message = xhr.responseJSON.message.replace('{$company}', `<strong>${companyName}</strong>`);
                            }

                            Swal.fire({
                                title: 'Opps!',
                                html: message,
                                icon: 'error',
                            });
                        }
                    });
                }
            });
        });
    </script>
@endpush

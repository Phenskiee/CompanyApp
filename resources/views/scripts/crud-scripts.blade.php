@push('js')
    <script>
        function initCrud(config) {

            const modal = $(`.${config.modalClass}`);

            modal.find('.addBtn').off().on('click', function () {

                let id = modal.find('input[name="id"]').val();
                let data = {};

                $.each(config.fields, function (field) {
                    data[field] = modal.find(`[name="${field}"]`).val();
                });

                let url = id 
                    ? `${config.routes.update}/${id}`
                    : config.routes.store;

                let method = id ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {

                        modal.hide();
                        modal.find('input, textarea').val('');
                        modal.find('.addBtn').text('Save');

                        let pagination = $(`.pagination[data-table="${config.tableId}"]`);
                        let currentPage = pagination.data('page') || 1;

                        loadTable(
                            config.tableId,
                            config.routes.table,
                            currentPage
                        );

                        if(Array.isArray(config.reloadTables)) {
                            config.reloadTables.forEach(function(tableId) {
                                loadTable(tableId, $(`.pagination[data-table="${tableId}"]`).data('route'), 1);
                            });
                        }

                        Swal.fire(
                            id ? 'Updated!' : 'Added!',
                            response.message,
                            'success'
                        );

                        updateDashboardCounters();
                    },
                    error: function (xhr) {
                        let msg = 'Please check your input.';
                        if(xhr.responseJSON && xhr.responseJSON.message) {
                            msg = xhr.responseJSON.message;
                        }
                        Swal.fire(
                            'Error',
                            msg,
                            'error'
                        );
                    }
                });
            });

            // EDIT 
            $(document).off('click', `#${config.tableId} .editBtn`);
            $(document).on('click', `#${config.tableId} .editBtn`, function () {

                let id = $(this).data('id');
                let modal = $(`.${config.modalClass}`);

                if (config.routes.show) {

                    $.get(`${config.routes.show}/${id}`, function (data) {

                        modal.find('input[name="id"]').val(data.id);

                        $.each(config.fields, function (field) {
                            modal.find(`[name="${field}"]`).val(data[field] ?? '');
                        });

                        modal.find('.modal-header span')
                            .text(`${data[Object.keys(config.fields)[0]] ?? ''}`);

                        modal.css('display', 'flex');
                        modal.find('.addBtn').text('Update');
                    });

                    return;
                }

                let row = $(this).closest('tr');

                modal.find('input[name="id"]').val(id);

                let index = 0;
                $.each(config.fields, function (field) {
                    modal.find(`[name="${field}"]`)
                        .val(row.find('td').eq(index).text());
                    index++;
                });

                modal.find('.modal-header span')
                    .text(`Edit: ${row.find('td').eq(0).text()}`);

                modal.css('display', 'flex');
                modal.find('.addBtn').text('Update');
            });

            // VIEW
            $(document).off('click', `#${config.tableId} .viewBtn`);
            $(document).on('click', `#${config.tableId} .viewBtn`, function () {

                let id = $(this).data('id');
                let modal = $(`.response-view-modal`);

                if (config.routes.show) {
                    $.get(`${config.routes.show}/${id}`, function (data) {

                        // Populate all fields
                        $.each(config.fields, function (field) {
                            modal.find(`[name="${field}"]`).val(data[field] ?? '');
                        });

                        modal.find('.modal-header span')
                            .text(`${data.company_name ?? ''}`);

                        modal.css('display', 'flex');
                    });

                    return;
                }
            });

            $(document).on('click', `.${config.modalClass} #close`, function() {
                let modal = $(`.${config.modalClass}`);
                modal.hide();
            });

            // DELETE
            $(document).on('click', `#${config.tableId} .deleteBtn`, function () {

                let id = $(this).data('id');
                let row = $(this).closest('tr');
                let name = row.find('td').eq(0).text();

                Swal.fire({
                    title: 'Are you sure?',
                    text: `Delete ${name}?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'Cancel'
                }).then((result) => {

                    if (result.isConfirmed) {
                        $.ajax({
                            url: `${config.routes.delete}/${id}`,
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {

                                let pagination = $(`.pagination[data-table="${config.tableId}"]`);
                                let currentPage = pagination.data('page') || 1;

                                loadTable(
                                    config.tableId,
                                    config.routes.table,
                                    currentPage
                                );

                                if(Array.isArray(config.reloadTables)) {
                                    config.reloadTables.forEach(function(tableId) {
                                        loadTable(tableId, $(`.pagination[data-table="${tableId}"]`).data('route'), 1);
                                    });
                                }

                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                );

                                updateDashboardCounters();
                            }
                        });
                    }
                });
            });
            // update
            updateDashboardCounters();
        }
    </script>
@endpush
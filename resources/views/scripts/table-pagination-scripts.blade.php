@push('js')
    <script>
        function loadTable(tableId, route, page = 1, buildHeaders = true, search = '', status_id = null) {
            $.ajax({
                url: route,
                method: 'GET',
                data: { page, search, status_id },
                dataType: 'json',
                success: function(data) {
                    const headers = data.headers || [];
                    const rows = data.rows || [];

                    if(buildHeaders) {
                        let thead = '<tr>';
                        headers.forEach(header => {
                            thead += `<th>${header}</th>`;
                        });
                        thead += '</tr>';
                        $(`#${tableId} thead`).html(thead);
                    }

                    let tbody = '';
                    if(rows.length > 0) {
                        rows.forEach(row => {
                            tbody += '<tr>';
                            row.forEach((cell, index) => {
                                let cellContent = cell;

                                if(typeof cell === 'object' && cell.ellipsis) {
                                    let menuHtml = `<div class="ellipsis-dropdown">
                                        <button class="ellipsis-btn" type="button">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <div class="ellipsis-menu" style="display:none;">`;
                                    cell.menuItems.forEach(item => {
                                        menuHtml += `<button class="ellipsis-item ${item.action}Btn" data-id="${item.id}" type="button">${item.label}</button>`;
                                    });
                                    menuHtml += '</div></div>';
                                    cellContent = menuHtml;
                                }

                                let boldClass = '';
                                if(headers[index] && headers[index].toLowerCase() === 'status') {
                                    boldClass = 'status-cell';
                                }

                                tbody += `<td class="${boldClass}">${cellContent}</td>`;
                            });
                            tbody += '</tr>';
                        });
                    } else {
                        tbody = `<tr><td colspan="${headers.length || 1}" class="text-center">No data available</td></tr>`;
                    }

                    $(`#${tableId} tbody`).html(tbody);

                    if(data.pagination) {
                        const pagination = $(`.pagination[data-table="${tableId}"]`);
                        const current = data.pagination.current_page;
                        const last = data.pagination.last_page;

                        let startPage = Math.max(current - 1, 1);
                        let endPage = Math.min(startPage + 2, last);
                        if(endPage - startPage + 1 < 3) startPage = Math.max(endPage - 2, 1);

                        let pagesHtml = '';
                        for(let i = startPage; i <= endPage; i++) {
                            pagesHtml += `<button class="page ${i===current?'active':''}" data-page="${i}">${i}</button>`;
                        }

                        pagination.find('.pages').html(pagesHtml);
                        pagination.find('.prev').prop('disabled', current === 1);
                        pagination.find('.next').prop('disabled', current === last);
                        pagination.data({ table: tableId, route, page: current });
                    }   
                },
                error: function() {
                    alert('Failed to load table data.');
                }
            });
        }

        $(document).ready(function() {
            // account table
            loadTable('accounts-table', "{{ route('account.table') }}", 1, true);
            // copmany list table
            loadTable('company-table', "{{ route('company.table') }}", 1, true);
            // response table
            loadTable('response-table', "{{ route('response.table') }}", 1, true);

            // Pagination event handlers
            $(document).on('click', '.pagination .page', function () {
                const pagination = $(this).closest('.pagination');
                loadTable(
                    pagination.data('table'),
                    pagination.data('route'),
                    $(this).data('page'),
                    false
                );
            });

            $(document).on('click', '.pagination .prev', function () {
                const pagination = $(this).closest('.pagination');
                const current = pagination.data('page');
                if(current > 1) {
                    loadTable(
                        pagination.data('table'),
                        pagination.data('route'),
                        current - 1,
                        false
                    );
                }
            });

            $(document).on('click', '.pagination .next', function () {
                const pagination = $(this).closest('.pagination');
                const current = pagination.data('page');
                loadTable(
                    pagination.data('table'),
                    pagination.data('route'),
                    current + 1,
                    false
                );
            });

            // Ellipsis
            $(document).on('click', '.ellipsis-btn', function(e) {
                e.stopPropagation();
                $('.ellipsis-menu').not($(this).siblings('.ellipsis-menu')).hide();
                $(this).siblings('.ellipsis-menu').toggle();
            });

            // // Close menu if click outside
            $(document).on('click', function() {
                $('.ellipsis-menu').hide();
            });
            
            $(document).on('click', '.ellipsis-item', function() {
                const action = $(this).attr('class').split(' ')[0].replace('Btn','');
                const id = $(this).data('id');
            });
        });
    </script>
@endpush
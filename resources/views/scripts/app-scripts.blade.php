@push('js')
    <script>
        $(document).ready(function () {
            // SIDEBAR SECTION
            const sidebarSection = () => {
                const $sections = $('.section-container');
                const $links = $('.sidebar-link');

                const resetAllModals = () => {
                    $('.modal-container').hide();
                    $('.modal-container input, textarea, select').val('');
                    $('.modal-container .addBtn').text('Save');
                };

                const showSection = (target) => {
                    resetAllModals();

                    $sections.hide();
                    $('.' + target).fadeIn(500);

                    $links.removeClass('active');

                    $links
                        .filter('[data-target="' + target +'"]')
                        .addClass('active');
                }

                showSection('dashboard-section');

                $links.on('click', function() {
                    showSection($(this).data('target'));
                });
            }

            // DROPDOWN
            const dropdownList = () => {
                $('[data-route]').each(function() {
                    const $select = $(this);
                    const route = $select.data('route');

                    $.ajax({
                        url: route,
                        method: 'GET',
                        dataType: 'json',
                        success: function(res) {
                            const items = res.dropdownList ?? [];
                            
                            items.forEach(item => {
                                $select.append(
                                    $('<option>', {
                                        value: item.id,
                                        text: item.name
                                    })
                                );
                            });
                        }
                    });
                });
            }

            const loadPersonalInfo = () => {
                $('#personal-btn').on('click', function() {
                    $('[data-route]').each(function() {
                        const $input = $(this);
                        const route = $input.data('route');
                        const name = $input.attr('name');

                        $.ajax({
                            url: route,
                            method: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                if ($input.is('input') || $input.is('textarea')) {
                                    $input.val(data[name] ?? '');
                                }
                            }
                        });
                    });
                });
            };
            
            const initializerFunction =  () => {
                dropdownList();
                sidebarSection();
                loadPersonalInfo();
            }

            initializerFunction();
        });
    </script>
@endpush
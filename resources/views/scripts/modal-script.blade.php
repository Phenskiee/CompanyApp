@push('js')
    <script>
        $(document).ready(function () {
            const modal = (openBtn, currentModal) => {
                const $modal = $(currentModal);

                $(openBtn).on('click', () => {
                    $modal.find('input, textarea, select').val('');
                    $modal.find('.addBtn').text('Save');

                    if ($modal.hasClass('account-modal')) {
                        $modal.find('.modal-header span').text('Add Company Account');
                    }

                    if ($modal.hasClass('add-modal')) {
                        $modal.find('.modal-header span').text('Add Application');
                    }

                    $modal.css('display', 'flex');
                });

                // CLOSE MODAL
                $modal.find('[id="close"]').on('click', () => {
                    $modal.css('display', 'none');
                });
            };

            // ADD MODAL
            modal('#open-add-modal', '.add-modal');
            // ACCOUNT MODAL
            modal('#open-account-modal', '.account-modal');
            // ACCOUNT MODAL
            modal('#personal-btn', '.personal-info-card');
        })
    </script>
@endpush
@push('js')
    <script>
        function updateDashboardCounters() {
            $.get("{{ route('dashboard.counts') }}", function(data) {
                $('#companiesCounter .counter').text(data.companies);
                $('#applicationsCounter .counter').text(data.applications);
                $('#pendingCounter .counter').text(data.pending);
                $('#viewedCounter .counter').text(data.viewed);
                $('#interviewCounter .counter').text(data.interview);
                $('#rejectedCounter .counter').text(data.rejected);
                $('#jobOfferCounter .counter').text(data.jobOffer);
                $('#afterInterviewPendingCounter .counter').text(data.afterInterviewPending);
                $('#afterInterviewRejectedCounter .counter').text(data.afterInterviewRejected);
            });
        }

        $(document).ready(function() {
            updateDashboardCounters();
        });
    </script>
@endpush

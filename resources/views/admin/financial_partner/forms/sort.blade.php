{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">
    <h3>Drag and Drop to Sort the Financial Partner</h3>
    <div id="financial_partner_sort_data_div">
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function () {
        refresh_financial_partner_sort_data();
    });
    function refresh_financial_partner_sort_data() {
        $.ajax({
            type: "GET",
            url: "{{ route('financial_partner_sort_data') }}",
            success: function (responseData) {
                $("#financial_partner_sort_data_div").html('');
                $("#financial_partner_sort_data_div").html(responseData);
                /**************************/
                $('#sortable').sortable({
                    update: function (event, ui) {
                        var faqOrder = $(this).sortable('toArray').toString();
                        $.post("{{ route('financial_partner_sort_data_update') }}", {faqOrder: faqOrder, _method: 'PUT', _token: '{{ csrf_token() }}'})
                    }
                });
                $("#sortable").disableSelection();
                /***************************/
            }
        });
    }
</script>
@endpush

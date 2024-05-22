{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">
    <h3>Drag and Drop to Sort the Members</h3>
    <div id="executive_member_sort_data_div">
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function () {
        refresh_club_sort_data();
    });
    function refresh_club_sort_data() {
        $.ajax({
            type: "GET",
            url: "{{ route('camp.commandant.member.sort.data') }}",
            success: function (responseData) {
                $("#executive_member_sort_data_div").html('');
                $("#executive_member_sort_data_div").html(responseData);
                /**************************/
                $('#sortable').sortable({
                    update: function (event, ui) {
                        var faqOrder = $(this).sortable('toArray').toString();
                        $.post("{{ route('camp.commandant.member.sort.update') }}", {faqOrder: faqOrder, _method: 'PUT', _token: '{{ csrf_token() }}'})
                    }
                });
                $("#sortable").disableSelection();
                /***************************/
            }
        });
    }
</script>
@endpush

{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">
    <h3>Drag and Drop to Sort the Members</h3>
    <div id="office_administration_member_sort_data_div">
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
            url: "{{ route('sub.committee.member.sort.data') }}",
            success: function (responseData) {
                $("#office_administration_member_sort_data_div").html('');
                $("#office_administration_member_sort_data_div").html(responseData);
                /**************************/
                $('#sortable').sortable({
                    update: function (event, ui) {
                        var faqOrder = $(this).sortable('toArray').toString();
                        $.post("{{ route('sub.committee.member.sort.update') }}", {faqOrder: faqOrder, _method: 'PUT', _token: '{{ csrf_token() }}'})
                    }
                });
                $("#sortable").disableSelection();
                /***************************/
            }
        });
    }
</script>
@endpush

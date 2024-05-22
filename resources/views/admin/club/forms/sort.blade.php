{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">
    <h3>{{__('messages.Drag_and_Drop_to_Sort_the_Clubs')}}</h3>


    <div id="club_sort_data_div">
    </div>
</div>
@push('scripts') 
<script>
    $(document).ready(function () {
        refresh_club_sort_data();
    });
    function refresh_club_sort_data() {
        // var language = $('#lang').val();
        $.ajax({
            type: "GET",
            url: "{{ route('club.sort.data') }}",
            // data: {lang: language},
            success: function (responseData) {
                $("#club_sort_data_div").html('');
                $("#club_sort_data_div").html(responseData);
                /**************************/
                $('#sortable').sortable({
                    update: function (event, ui) {
                        var faqOrder = $(this).sortable('toArray').toString();
                        $.post("{{ route('club.sort.update') }}", {faqOrder: faqOrder, _method: 'PUT', _token: '{{ csrf_token() }}'})
                    }
                });
                $("#sortable").disableSelection();
                /***************************/
            }
        });
    }
</script>
@endpush

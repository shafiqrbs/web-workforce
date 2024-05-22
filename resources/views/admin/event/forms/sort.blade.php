{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">
    <h3>Drag and Drop to Sort the Events</h3>
    <div id="event_sort_data_div">
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
            url: "{{ route('event.sort.data') }}",

            success: function (responseData) {
                $("#event_sort_data_div").html('');
                $("#event_sort_data_div").html(responseData);
                /**************************/
                $('#sortable').sortable({
                    update: function (event, ui) {
                        var eventOrder = $(this).sortable('toArray').toString();
                        $.post("{{ route('event.sort.update') }}", {eventOrder: eventOrder, _method: 'PUT', _token: '{{ csrf_token() }}'})
                    }
                });
                $("#sortable").disableSelection();
            }
        });
    }
</script>
@endpush

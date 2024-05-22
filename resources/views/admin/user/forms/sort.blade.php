{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">
    <h3>Drag and Drop to Sort the Athletes</h3>
    <div id="archive_sort_data_div">
    </div>
</div>
@push('scripts') 
<script>
    $(document).ready(function () {
        refresh_archive_sort_data();
    });
    function refresh_archive_sort_data() {
        $.ajax({
            type: "GET",
            url: "{{ route('athletes.sort.data') }}",

            success: function (responseData) {
                $("#archive_sort_data_div").html('');
                $("#archive_sort_data_div").html(responseData);
                /**************************/
                $('#sortable').sortable({
                    update: function (event, ui) {
                        var archiveOrder = $(this).sortable('toArray').toString();
                        $.post("{{ route('athletes.sort.update') }}", {archiveOrder: archiveOrder, _method: 'PUT', _token: '{{ csrf_token() }}'})
                    }
                });
                $("#sortable").disableSelection();
            }
        });
    }
</script>
@endpush

{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">
    <h3>Drag and Drop to Sort the Archives</h3>
    <div id="profession_sort_data_div">
    </div>
</div>
@push('scripts') 
<script>
    $(document).ready(function () {
        refresh_profession_sort_data();
    });
    function refresh_profession_sort_data() {
        $.ajax({
            type: "GET",
            url: "{{ route('profession.sort.data') }}",

            success: function (responseData) {
                $("#profession_sort_data_div").html('');
                $("#profession_sort_data_div").html(responseData);
                /**************************/
                $('#sortable').sortable({
                    update: function (event, ui) {
                        var professionOrder = $(this).sortable('toArray').toString();
                        $.post("{{ route('profession.sort.update') }}", {professionOrder: professionOrder, _method: 'PUT', _token: '{{ csrf_token() }}'})
                    }
                });
                $("#sortable").disableSelection();
            }
        });
    }
</script>
@endpush

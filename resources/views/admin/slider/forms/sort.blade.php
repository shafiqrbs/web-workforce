{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">
    <h3>Drag and Drop to Sort Sliders</h3>
    <div id="sliderSortDataDiv"></div>
</div>
@push('scripts') 
<script>
    $(document).ready(function () {
        refreshSliderSortData();
    });
    function refreshSliderSortData() {
        $.ajax({
            type: "GET",
            url: "{{ route('slider.sort.data') }}",
            success: function (responseData) {
                $("#sliderSortDataDiv").html('');
                $("#sliderSortDataDiv").html(responseData);
                /**************************/
                $('#sortable').sortable({
                    update: function (event, ui) {
                        var sliderOrder = $(this).sortable('toArray').toString();
                        $.post("{{ route('slider.sort.update') }}", {sliderOrder: sliderOrder, _method: 'PUT', _token: '{{ csrf_token() }}'})
                    }
                });
                $("#sortable").disableSelection();
                /***************************/
            }
        });
    }
</script> 
@endpush

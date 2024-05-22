{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">
    <h3>Drag and Drop to Sort CMS</h3>
{{--    {!! Form::select('lang', ['' => 'Select Language']+$languages, config('default_lang'), array('class'=>'form-control', 'id'=>'lang', 'onchange'=>'refreshGenderSortData();')) !!}--}}
    <div id="cmsSortDataDiv"></div>
</div>
@push('scripts') 
<script>
    $(document).ready(function () {
        refreshGenderSortData();
    });
    function refreshGenderSortData() {
        var language = $('#lang').val();
        $.ajax({
            type: "GET",
            url: "{{ route('cms.sort.data') }}",
            data: {lang: language},
            success: function (responseData) {
                $("#cmsSortDataDiv").html('');
                $("#cmsSortDataDiv").html(responseData);
                /**************************/
                $('#sortable').sortable({
                    update: function (event, ui) {
                        var cmsOrder = $(this).sortable('toArray').toString();
                        $.post("{{ route('cms.sort.update') }}", {cmsOrder: cmsOrder, _method: 'PUT', _token: '{{ csrf_token() }}'})
                    }
                });
                $("#sortable").disableSelection();
                /***************************/
            }
        });
    }
</script> 
@endpush

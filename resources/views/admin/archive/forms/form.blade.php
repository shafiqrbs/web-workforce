<?php
$lang = config('default_lang');
if (isset($faq))
    $lang = $faq->lang;
$lang = MiscHelper::getLang($lang);
$direction = MiscHelper::getLangDirection($lang);
$queryString = MiscHelper::getLangQueryStr();
?>
{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">

    <div class="row">
        <div class="col-md-12">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'type') !!}">
                {!! Form::label('Event Type', 'Choose Type', ['class' => 'bold']) !!} <span class="red">*</span>
                {!! Form::select('type', ['' =>'Choose type']+['achievement'=>'Achievement','notice'=>'Notice','resource'=>'Resource','case-story'=>'Case Story'],null, array('class'=>'form-control type', 'id'=>'type','required'=>'required')) !!}
                {!! APFrmErrHelp::showErrors($errors, 'type') !!}
            </div>
        </div>
        <div class="col-md-12">
            {!! Form::hidden('id', null) !!}
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'archive_name') !!}">
                {!! Form::label('Archive name',__('messages.post_Name'), ['class' => 'bold']) !!} <span class="red">*</span>
                {!! Form::text('archive_name', null, array('class'=>'form-control', 'id'=>'archive_name', 'placeholder'=>__('messages.post_Name'), 'autocomplete'=>'off', 'required'=>'required' )) !!}
                {!! APFrmErrHelp::showErrors($errors, 'archive_name') !!}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'sub_title') !!}">
                {!! Form::label('Sub Title', __('messages.Sub_Title'), ['class' => 'bold']) !!} <span class="red">*</span>
                {!! Form::textarea('sub_title', null, array('class'=>'form-control', 'id'=>'description', 'placeholder'=> __('messages.Sub_Title'), 'autocomplete'=>'off','autofocus'=>'on' )) !!}
                {!! APFrmErrHelp::showErrors($errors, 'sub_title') !!}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'sub_title') !!}">
                {!! Form::label('Sub Title', __('messages.short_description'), ['class' => 'bold']) !!} {{--<span class="red">*</span>--}}
                {!! Form::textarea('short_description', null, array('class'=>'form-control', 'placeholder'=> __('messages.short_description'), 'autocomplete'=>'off','autofocus'=>'on' )) !!}
                {!! APFrmErrHelp::showErrors($errors, 'short_description') !!}
            </div>
        </div>

        <div class="col-md-12">
            @if(isset($archive))
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'feature_image') !!}">
                    {!! Form::label('Feature Image',  __('messages.Feature_Image'), ['class' => 'bold']) !!}
                    {!! Form::file('feature_image', array('class'=>'form-control', 'id'=>'feature_image', 'autocomplete'=>'off','accept'=>"application/image")) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'feature_image') !!}
                </div>
                <input type="hidden" name="form_type" value="update">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ ImgUploader::print_image("archive/mid/$archive->feature_image") }}
                        </div>
                    </div>
                </div>
            @else
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'feature_image') !!}">
                    {!! Form::label('Archive PDF',__('messages.Feature_Image'), ['class' => 'bold']) !!} {{--<span class="red">*</span>--}}
                    {!! Form::file('feature_image', array('class'=>'form-control', 'id'=>'feature_image', 'autocomplete'=>'off','accept'=>"application/image")) !!}
                    <input type="hidden" name="form_type" value="insert">
                    {!! APFrmErrHelp::showErrors($errors, 'feature_image') !!}
                </div>
            @endif
        </div>

        <div class="col-md-12">
            @if(isset($archive))
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'archive_pdf') !!}">
                    {!! Form::label('Post PDF',  __('messages.Archive_PDF'), ['class' => 'bold']) !!}
                    {!! Form::file('archive_pdf', array('class'=>'form-control', 'id'=>'archive_pdf', 'autocomplete'=>'off','accept'=>"application/pdf")) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'archive_pdf') !!}
                </div>
                <input type="hidden" name="form_type" value="update">
                <a href="{{ route('archive.download',$archive->id) }}">
                    {!! Form::label($archive->archive_pdf, $archive->archive_pdf, ['class' => 'bold','style'=>'cursor: pointer;background: #dfdddd;padding: 5px 5px;','title'=>'Download']) !!}
                </a>
            @else
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'archive_pdf') !!}">
                    {!! Form::label('Archive PDF',__('messages.post_PDF'), ['class' => 'bold']) !!} {{--<span class="red">*</span>--}}
                    {!! Form::file('archive_pdf', array('class'=>'form-control', 'id'=>'archive_pdf', 'autocomplete'=>'off','accept'=>"application/pdf")) !!}
                    <input type="hidden" name="form_type" value="insert">
                    {!! APFrmErrHelp::showErrors($errors, 'archive_pdf') !!}
                </div>
            @endif
        </div>

            <div class="col-md-12">
                <a style="display: none" id="moreattachroute" data-href="{{route('multiple_attach_for_archive')}}" ></a>
                {!! Form::label('Multiple PDF','Multiple PDF', ['class' => 'bold']) !!}
                <table class="table table-striped table-bordered table-hover">
                    <thead id="add_more_attach_row">
                    <tr>
                        <td>PDF</td>
                        <td>Caption</td>
                        <td>Action</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="file" id="file" name="file[]" class="form-control" accept="application/pdf" multiple />
                        </td>
                        <td>
                            {!! Form::text('caption[]', null, array('class'=>'form-control caption', 'id'=>'caption', 'placeholder'=>'Caption')) !!}
                        </td>
                        <td class="text-center">
                            <button sl-no="1" id="MoreAttachment" type="button" class="btn btn-primary btn-sm">Add More</button>
                        </td>
                    </tr>
                    </thead>
                    @if(isset($moreAttachment) && count($moreAttachment)>0)
                    <tbody>
                        @foreach($moreAttachment as $attachment)
                            <tr>
                                <td>
                                    <a href="{{ route('archive_multiple_download',$attachment['id']) }}">
                                        {!! Form::label($attachment['attachment'], $attachment['attachment'], ['class' => 'bold','style'=>'cursor: pointer;background: #dfdddd;padding: 5px 5px;','title'=>'Download']) !!}
                                    </a>
                                </td>
                                <td>{{$attachment['caption']}}</td>
                                <td class="text-center">
                                    <a href="{{route('delete_archive_attachment',$attachment['id'])}}" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    @endif
                </table>
            </div>


    </div>


        <div class="form-actions">
            {!! Form::button(__('messages.Save').' <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
        </div>

</div>
@push('scripts')
<script type="text/javascript">
    function setLang(lang) {
        window.location.href = "<?php echo url(Request::url()) . $queryString; ?>" + lang;
    }

    $(document).delegate('#MoreAttachment','click',function () {
        var sl_no = $(this).attr('sl-no');
        var sl_no = parseInt(sl_no);
        var route = $('#moreattachroute').attr('data-href');
        sl_no += 1;
        $.ajax({
            url: route,
            method: "GET",
            dataType: "json",
            data: {sl_no: sl_no},
            beforeSend: function( xhr ) {

            }
        }).done(function( response ) {
            $('#add_more_attach_row').append(response.content);
            document.getElementById("MoreAttachment").setAttribute("sl-no",response.sl_no);
        }).fail(function( jqXHR, textStatus ) {

        });
        return false;
    });

    $(document).delegate('#delete_click','click',function () {
        var sl_no = $(this).attr('sl_no');
        document.getElementById("delete_row_"+sl_no).remove();
    });
</script>
{{--@include('admin.shared.tinyMCE')--}}

<script src="{{ asset('admin_assets/global/plugins/tinymce/js/tinymce/jquery.tinymce.min.js') }}"></script>

<script src="{{ asset('admin_assets/global/plugins/tinymce/js/tinymce/tinymce.min.js') }}"></script>

<script>

    tinymce.init({

        selector: '#description',
        height: 350,
        entity_encoding : "raw",
        forced_root_block: '',
        convert_urls: false,
        plugins: [
            'advlist','autolink','link','lists','image', 'searchreplace', 'visualblocks', 'code', 'fullscreen','media', 'table' ,'contextmenu' ,'paste' ,'code','preview'

        ],

        toolbar: 'insertfile undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image|print preview media ',

        menubar: 'favs file edit view insert format tools table help',

        relative_urls: true,
        images_upload_url: "{{ route('tinymce.image_upload.front') }}",
        images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', "{{ route('tinymce.image_upload.front') }}");
            xhr.onload = function () {
                var json;
                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }

                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }

                success(json.location);

            };

            formData = new FormData();

            formData.append('image', blobInfo.blob(), blobInfo.filename());

            xhr.send(formData);

        },

    });



    tinymce.init({

        selector: '#benefits',

        height: 150,

        entity_encoding : "raw",

        forced_root_block: '',

        plugins: [

            'advlist autolink lists image',

            'searchreplace visualblocks code fullscreen',

            'media table contextmenu paste code'

        ],

        toolbar: 'insertfile undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image',

        relative_urls: true,

        images_upload_url: "{{ route('tinymce.image_upload.front') }}",

        images_upload_handler: function (blobInfo, success, failure) {

            var xhr, formData;

            xhr = new XMLHttpRequest();

            xhr.withCredentials = false;

            xhr.open('POST', "{{ route('tinymce.image_upload.front') }}");

            xhr.onload = function () {

                var json;

                if (xhr.status != 200) {

                    failure('HTTP Error: ' + xhr.status);

                    return;

                }

                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {

                    failure('Invalid JSON: ' + xhr.responseText);

                    return;

                }

                success(json.location);

            };

            formData = new FormData();

            formData.append('image', blobInfo.blob(), blobInfo.filename());

            xhr.send(formData);

        },

    });

</script>
@endpush
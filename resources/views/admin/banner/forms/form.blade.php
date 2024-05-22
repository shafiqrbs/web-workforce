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
            {!! Form::hidden('id', null) !!}
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'banner_title') !!}">
                {!! Form::label('Banner Title', 'Banner Title', ['class' => 'bold']) !!} <span class="red">*</span>
                {!! Form::text('banner_title', null, array('class'=>'form-control', 'id'=>'banner_title', 'placeholder'=>'Banner Title', 'autocomplete'=>'off' )) !!}
                {!! APFrmErrHelp::showErrors($errors, 'banner_title') !!}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'page_slug') !!}">
                {!! Form::label('Pages', 'Pages', ['class' => 'bold']) !!} <span class="red">*</span>
                {!! Form::select('page_slug', ['' => 'Select Page']+$slug, null, ['class' => ' form-control select2','id'=>'',]) !!}
                {!! APFrmErrHelp::showErrors($errors, 'page_slug') !!}
            </div>
        </div>

        <div class="col-md-12">
            @if(isset($banner))
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'banner_image') !!}">
                    {!! Form::label('Banner Image', 'Banner Image', ['class' => 'bold']) !!} <span style="font-size: 10px">( Greater than or equal to width 1920px & height 730px. )</span>
                    {!! Form::file('banner_image', array('class'=>'form-control', 'id'=>'banner_image', 'autocomplete'=>'off','accept'=>"image/png, image/jpeg")) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'banner_image') !!}
                </div>
                <input type="hidden" name="form_type" value="update">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ ImgUploader::print_image("banner/thumb/$banner->banner_image") }}
                        </div>
                    </div>
                </div>
            @else
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'banner_image') !!}">
                    {!! Form::label('Banner Image', 'Banner Image', ['class' => 'bold']) !!} <span class="red">*</span> <span style="font-size: 10px">( Greater than or equal to width 1920px & height 730px. )</span>
                    {!! Form::file('banner_image', array('class'=>'form-control', 'id'=>'banner_image', 'autocomplete'=>'off','accept'=>"image/png, image/jpeg")) !!}
                    <input type="hidden" name="form_type" value="insert">
                    {!! APFrmErrHelp::showErrors($errors, 'banner_image') !!}
                </div>
            @endif
        </div>

    </div>


        <div class="form-actions">
            {!! Form::button('Save <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
        </div>

</div>
@push('scripts')
<script type="text/javascript">
    function setLang(lang) {
        window.location.href = "<?php echo url(Request::url()) . $queryString; ?>" + lang;
    }
</script>
@include('admin.shared.tinyMCE')
@endpush
<?php
$lang = config('default_lang');
if (isset($cmsContent))
    $lang = $cmsContent->lang;
$lang = MiscHelper::getLang($lang);
$direction = MiscHelper::getLangDirection($lang);
$queryString = MiscHelper::getLangQueryStr();
?>
{!! APFrmErrHelp::showErrorsNotice($errors) !!}
<div class="form-body">
    {{--<div class="form-group {!! APFrmErrHelp::hasError($errors, 'page_slug') !!}">
        {!! Form::label('page_slug', 'Page Slug', ['class' => 'bold']) !!}
        {!! Form::text('page_slug', null, array('class'=>'form-control', 'id'=>'page_slug', 'placeholder'=>'Page Slug')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'page_slug') !!}
    </div>--}}

    {{--<div class="form-group {!! APFrmErrHelp::hasError($errors, 'parent_id') !!}">
        {!! Form::label('parent_id', 'Parent', ['class' => 'bold']) !!}
        {!! Form::select('parent_id', $parentCms,isset($cms)&&$cms->parent_id?$cms->parent_id:null, array('class'=>'form-control', 'id'=>'parent_id', 'placeholder'=>'Select Parent')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'parent_id') !!}
    </div>--}}


    {{--<div class="form-group {!! APFrmErrHelp::hasError($errors, 'lang') !!}">
        {!! Form::label('lang', 'Language', ['class' => 'bold']) !!}
        {!! Form::select('lang', ['' => 'Select Language']+$languages, $lang, array('class'=>'form-control', 'id'=>'lang', 'onchange'=>'setLang(this.value)')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'lang') !!}
    </div>--}}
    {{--<div class="form-group {!! APFrmErrHelp::hasError($errors, 'page_id') !!}">
        {!! Form::label('page_id', 'CMS Page', ['class' => 'bold']) !!}
        {!! Form::select('page_id', ['' => 'Select page']+$cmsPages, null, array('class'=>'form-control', 'id'=>'page_id')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'page_id') !!}
    </div>  --}}
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'page_title') !!}">
        {!! Form::label('page_title', 'Page Title', ['class' => 'bold']) !!}
        {!! Form::text('page_title', null, array('class'=>'form-control', 'id'=>'page_title', 'placeholder'=>'Page Title', 'dir'=>$direction)) !!}
        {!! APFrmErrHelp::showErrors($errors, 'page_title') !!}
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'page_content') !!}">
        {!! Form::label('page_content', 'Page Content', ['class' => 'bold']) !!}
        {!! Form::textarea('page_content', null, array('class'=>'form-control', 'id'=>'page_content', 'placeholder'=>'Page Content')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'page_content') !!}
    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'show_in_top_menu') !!}">
        {!! Form::label('show_in_top_menu', 'Show in top Menu', ['class' => 'bold']) !!}
        <div class="radio-list">
            <?php
            $radio_1 = 'checked="checked"';
            $radio_2 = '';
            if (old('show_in_top_menu', ((isset($cms)) ? $cms->show_in_top_menu : 1)) == 0) {
                $radio_1 = '';
                $radio_2 = 'checked="checked"';
            }
            ?>
            <label class="radio-inline">
                <input id="show_in_top_menu" name="show_in_top_menu" type="radio" value="1" {{$radio_1}}>
                Yes </label>
            <label class="radio-inline">
                <input id="not_show_in_top_menu" name="show_in_top_menu" type="radio" value="0" {{$radio_2}}>
                No </label>
        </div>
        {!! APFrmErrHelp::showErrors($errors, 'show_in_top_menu') !!}
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'show_in_footer_menu') !!}">
        {!! Form::label('show_in_footer_menu', 'Show in footer Menu', ['class' => 'bold']) !!}
        <div class="radio-list">
            <?php
            $radio_1 = 'checked="checked"';
            $radio_2 = '';
            if (old('show_in_footer_menu', ((isset($cms)) ? $cms->show_in_footer_menu : 1)) == 0) {
                $radio_1 = '';
                $radio_2 = 'checked="checked"';
            }
            ?>
            <label class="radio-inline">
                <input id="show_in_footer_menu" name="show_in_footer_menu" type="radio" value="1" {{$radio_1}}>
                Yes </label>
            <label class="radio-inline">
                <input id="not_show_in_footer_menu" name="show_in_footer_menu" type="radio" value="0" {{$radio_2}}>
                No </label>
        </div>
        {!! APFrmErrHelp::showErrors($errors, 'show_in_footer_menu') !!}
    </div>
    <input type="file" name="image" id="image" style="display:none;" accept="image/*"/>
</div>
@push('scripts')
<script type="text/javascript">
    function setLang(lang) {
        window.location.href = "<?php echo url(Request::url()) . $queryString; ?>" + lang;
    }
</script>
@include('admin.shared.cms_form_tinyMCE', array($lang, $direction))
@endpush
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

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'page_title') !!}">
        {!! Form::label('page_title', 'Page Title', ['class' => 'bold']) !!}
        {!! Form::text('page_title', null, array('class'=>'form-control', 'id'=>'page_title', 'placeholder'=>'Page Title', 'dir'=>$direction)) !!}
        {!! APFrmErrHelp::showErrors($errors, 'page_title') !!}
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'page_sub_title') !!}">
        {!! Form::label('page_sub_title', 'Page Sub Title', ['class' => 'bold']) !!}
        {!! Form::text('page_title', null, array('class'=>'form-control', 'id'=>'page_sub_title', 'placeholder'=>'Page Sub Title', 'dir'=>$direction)) !!}
        {!! APFrmErrHelp::showErrors($errors, 'page_sub_title') !!}
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'page_content') !!}">
        {!! Form::label('page_content', 'Page Content', ['class' => 'bold']) !!}
        {!! Form::textarea('page_content', null, array('class'=>'form-control', 'id'=>'page_content', 'placeholder'=>'Page Content')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'page_content') !!}
    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'profile_image') !!}">
        @if(isset($cms))
            <input type="hidden" name="form_type" value="update">
            {!! Form::label('image', 'Image', ['class' => 'bold']) !!} <span style="font-size: 10px">( Greater than or equal to width 270px & height 270px. )</span>
            {!! Form::File('image', array('class'=>'form-control', 'id'=>'image')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'image') !!}
            @if($cmsContent->image)
                <img src="{{asset('page_image/mid/'.$cmsContent->image)}}" alt="" class="img-fluid">
            @endif
        @else
            <input type="hidden" name="form_type" value="insert">
            {!! Form::label('image', 'Image', ['class' => 'bold']) !!} <span style="font-size: 10px">( Greater than or equal to width 270px & height 270px. )</span>
            {!! Form::File('image', array('class'=>'form-control', 'id'=>'image')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'image') !!}
        @endif
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
{{--    <input type="file" name="image" id="image" style="display:none;" accept="image/*"/>--}}
</div>
@push('scripts')
<script type="text/javascript">
    function setLang(lang) {
        window.location.href = "<?php echo url(Request::url()) . $queryString; ?>" + lang;
    }
</script>
@include('admin.shared.cms_form_tinyMCE', array($lang, $direction))
@endpush
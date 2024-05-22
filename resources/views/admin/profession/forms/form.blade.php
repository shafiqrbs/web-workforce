<?php
$lang = config('default_lang');
if (isset($careerLevel))
    $lang = $careerLevel->lang;
$lang = MiscHelper::getLang($lang);
$direction = MiscHelper::getLangDirection($lang);
$queryString = MiscHelper::getLangQueryStr();
?>
{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'profession') !!}"> {!! Form::label('profession', 'Profession', ['class' => 'bold']) !!}
        {!! Form::text('profession', null, array('class'=>'form-control', 'id'=>'profession', 'placeholder'=>'Profession Name', 'dir'=>$direction)) !!}
        {!! APFrmErrHelp::showErrors($errors, 'profession') !!}
    </div>


    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'is_default') !!}"> {!! Form::label('is_default', 'Is Default?', ['class' => 'bold']) !!}
        <div class="radio-list">
            <?php
            $is_default_1 = 'checked="checked"';
            $is_default_2 = '';
            if (old('is_default', ((isset($profession)) ? $profession->is_default : 1)) == 0) {
                $is_default_1 = '';
                $is_default_2 = 'checked="checked"';
            }
            ?>
            <label class="radio-inline">
                <input id="default" name="is_default" type="radio" value="1" {{$is_default_1}} onchange="showHideCareerLevelId();">
                Yes </label>
            <label class="radio-inline">
                <input id="not_default" name="is_default" type="radio" value="0" {{$is_default_2}} onchange="showHideCareerLevelId();">
                No </label>
        </div>
        {!! APFrmErrHelp::showErrors($errors, 'is_default') !!} </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'is_active') !!}"> {!! Form::label('is_active', 'Active', ['class' => 'bold']) !!}
        <div class="radio-list">
            <?php
            $is_active_1 = 'checked="checked"';
            $is_active_2 = '';
            if (old('is_active', ((isset($profession)) ? $profession->is_active : 1)) == 0) {
                $is_active_1 = '';
                $is_active_2 = 'checked="checked"';
            }
            ?>
            <label class="radio-inline">
                <input id="active" name="is_active" type="radio" value="1" {{$is_active_1}}>
                Active </label>
            <label class="radio-inline">
                <input id="not_active" name="is_active" type="radio" value="0" {{$is_active_2}}>
                In-Active </label>
        </div>
        {!! APFrmErrHelp::showErrors($errors, 'is_active') !!} </div>
    <div class="form-actions"> {!! Form::button('Update <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!} </div>
</div>
@push('scripts')

@endpush
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
    @if(isset($event))
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ ImgUploader::print_image("event/thumb/$event->event_image") }}
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'event_name') !!}">
                {!! Form::label('Event name', __('messages.Event_Name'), ['class' => 'bold']) !!} <span class="red">*</span>
                {!! Form::text('event_name', null, array('class'=>'form-control', 'id'=>'event_name', 'placeholder'=>__('messages.Event_Name'), 'autocomplete'=>'off', 'required'=>'required' )) !!}
                {!! APFrmErrHelp::showErrors($errors, 'event_name') !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'event_image') !!}">
                @if(isset($event))
                    <input type="hidden" name="form_type" value="update">
                    {!! Form::label('Event Image', __('messages.Event_Image'), ['class' => 'bold']) !!} <span style="font-size: 10px">( {{__('messages.Greater_than_or_equal_to_width_1920px_height_730px')}} )</span>
                    {!! Form::File('event_image', array('class'=>'form-control', 'id'=>'event_image')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'event_image') !!}
                @else
                    <input type="hidden" name="form_type" value="insert">
                    {!! Form::label('Event Image',  __('messages.Event_Image'), ['class' => 'bold']) !!} <span class="red">*</span> <span style="font-size: 10px">( {{__('messages.Greater_than_or_equal_to_width_1920px_height_730px')}} )</span>
                    {!! Form::File('event_image', array('class'=>'form-control', 'id'=>'event_image','required'=>'required' )) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'event_image') !!}
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'event_type') !!}">
                {!! Form::label('Event Type', __('messages.Enter_type'), ['class' => 'bold']) !!} <span class="red">*</span>
                {!! Form::select('event_type_id', ['' =>'Choose event type']+$eventType,null, array('class'=>'form-control event_type', 'id'=>'event_type','required'=>'required')) !!}

                {!! APFrmErrHelp::showErrors($errors, 'event_type_id') !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'number_of_club') !!}">
                {!! Form::label('Number Of Clubs', __('messages.Number_Of_Clubs'), ['class' => 'bold']) !!} </span>
                {!! Form::text('number_of_club', null, array('class'=>'form-control', 'id'=>'number_of_club', 'placeholder'=>__('messages.Number_Of_Clubs'), 'autocomplete'=>'off')) !!}
                {!! APFrmErrHelp::showErrors($errors, 'number_of_club') !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'number_of_athlete') !!}">
                {!! Form::label('Number Of Athletes', __('messages.Number_Of_Athletes'), ['class' => 'bold']) !!}
                {!! Form::text('number_of_athlete', null, array('class'=>'form-control', 'id'=>'number_of_athlete', 'placeholder'=> __('messages.Number_Of_Athletes'), 'autocomplete'=>'off' )) !!}
                {!! APFrmErrHelp::showErrors($errors, 'number_of_athlete') !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'number_of_official') !!}">
                {!! Form::label('Number Of Officials', __('messages.Number_Of_Officials'), ['class' => 'bold']) !!}
                {!! Form::text('number_of_official', null, array('class'=>'form-control', 'id'=>'number_of_official', 'placeholder'=> __('messages.Number_Of_Officials'), 'autocomplete'=>'off')) !!}
                {!! APFrmErrHelp::showErrors($errors, 'number_of_official') !!}
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'participant') !!}">
                {!! Form::label('Number Of Participant', 'Number Of Participant', ['class' => 'bold']) !!}
                {!! Form::text('participant', null, array('class'=>'form-control', 'id'=>'participant', 'placeholder'=> 'Number Of Participant', 'autocomplete'=>'off' )) !!}
                {!! APFrmErrHelp::showErrors($errors, 'participant') !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'location') !!}">
                {!! Form::label('Location', 'Location', ['class' => 'bold']) !!}
                {!! Form::text('location', null, array('class'=>'form-control', 'id'=>'location', 'placeholder'=> 'Location', 'autocomplete'=>'off')) !!}
                {!! APFrmErrHelp::showErrors($errors, 'location') !!}
            </div>
        </div>
    </div>


        <div class="row">
            <div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'start_date') !!}">
                    {!! Form::label(__('messages.Start_date'), __('messages.Start_date'), ['class' => 'bold']) !!} <span class="red">*</span>
                    {!! Form::date('start_date', null, array('class'=>'form-control', 'id'=>'start_date', 'placeholder'=> __('messages.Start_date'), 'autocomplete'=>'off','required'=>'required' )) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'start_date') !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'end_date') !!}">
                    {!! Form::label(__('messages.End_date'), __('messages.End_date'), ['class' => 'bold']) !!}
                    {!! Form::date('end_date', null, array('class'=>'form-control', 'id'=>'end_date', 'placeholder'=> __('messages.End_date'), 'autocomplete'=>'off')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'end_date') !!}
                </div>
            </div>
        </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'event_message') !!}">
                {!! Form::label('Event Message', __('messages.Event_Message'), ['class' => 'bold']) !!}
                {!! Form::textarea('event_message', null, array('class'=>'form-control', 'id'=>'event_message', 'placeholder'=>__('messages.Event_Message'), 'autocomplete'=>'off','rows'=>3)) !!}
                {!! APFrmErrHelp::showErrors($errors, 'event_message') !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'match_schedule_message') !!}">
                {!! Form::label('Match Schedule Message', __('messages.Match_Schedule_Message'), ['class' => 'bold']) !!}
                {!! Form::textarea('match_schedule_message', null, array('class'=>'form-control', 'id'=>'match_schedule_message', 'placeholder'=> __('messages.Match_Schedule_Message'), 'autocomplete'=>'off','rows'=>3)) !!}
                {!! APFrmErrHelp::showErrors($errors, 'match_schedule_message') !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'match_schedule_pdf') !!}">
                {!! Form::label('Match Schedule PDF', __('messages.Match_Schedule_PDF'), ['class' => 'bold']) !!}
                {!! Form::file('match_schedule_pdf', array('class'=>'form-control', 'id'=>'match_schedule_pdf', 'placeholder'=>__('messages.Match_Schedule_PDF'), 'autocomplete'=>'off','rows'=>3,'accept'=>"application/pdf")) !!}
                {!! APFrmErrHelp::showErrors($errors, 'match_schedule_pdf') !!}
            </div>
            @if(isset($event))
                <a href="{{ route('match.schedule.download',$event->id) }}">
                    {!! Form::label($event->match_schedule_pdf, $event->match_schedule_pdf, ['class' => 'bold','style'=>'    cursor: pointer;background: #dfdddd;padding: 5px 5px;','title'=>'Download']) !!}
                </a>
            @endif
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
</script>
@include('admin.shared.tinyMCE')
@endpush
{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">
    @if(isset($jury))
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ ImgUploader::print_image("jury/thumb/$jury->profile_image") }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ ImgUploader::print_image("jury/thumb/$jury->profile_image") }}
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'name') !!}">
                {!! Form::label('name', __('messages.Name'), ['class' => 'bold']) !!} <span class="red">*</span>
                {!! Form::text('name', null, array('class'=>'form-control', 'id'=>'name', 'placeholder'=> __('messages.Name'), 'autocomplete'=>'off', 'required'=>'required')) !!}
                {!! APFrmErrHelp::showErrors($errors, 'name') !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'profile_image') !!}">
                @if(isset($jury))
                    <input type="hidden" name="form_type" value="update">
                    {!! Form::label('profile_image', 'Profile Image', ['class' => 'bold']) !!} <span style="font-size: 10px">( {{__('messages.Profile_Image_size_270')}} )</span>
                    {!! Form::File('profile_image', array('class'=>'form-control', 'id'=>'profile_image')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'profile_image') !!}
                @else
                    <input type="hidden" name="form_type" value="insert">
                    {!! Form::label('profile_image', __('messages.Profile_Image'), ['class' => 'bold']) !!} <span class="red">*</span> <span style="font-size: 10px">( {{__('messages.Profile_Image_size_270')}})</span>
                    {!! Form::File('profile_image', array('class'=>'form-control', 'id'=>'profile_image','required'=>'required')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'profile_image') !!}
                @endif
            </div>
        </div>
    </div>

        <div class="row">
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'mobile') !!}">
                {!! Form::label('mobile', __('messages.Mobile_Number'), ['class' => 'bold']) !!} <span class="red">*</span>
                {!! Form::text('mobile', null, array('class'=>'form-control', 'id'=>'mobile', 'placeholder'=> __('messages.Mobile_Number'), 'autocomplete'=>'off','required'=>'required')) !!}
                {!! APFrmErrHelp::showErrors($errors, 'mobile') !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'email') !!}">
                {!! Form::label('email', __('messages.Email'), ['class' => 'bold']) !!} <span class="red">*</span>
                {!! Form::text('email', null, array('class'=>'form-control', 'id'=>'email', 'placeholder'=>__('messages.Email'), 'autocomplete'=>'off','required'=>'required')) !!}
                {!! APFrmErrHelp::showErrors($errors, 'email') !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'issf_License_No') !!}">
                {!! Form::label('issf_License_No',__('messages.ISSF_License_No'), ['class' => 'bold']) !!} <span class="red">*</span>
                {!! Form::text('issf_license_no', null, array('class'=>'form-control', 'id'=>'issf_license_no', 'placeholder'=>__('messages.ISSF_License_No'), 'autocomplete'=>'off','required'=>'required')) !!}
                {!! APFrmErrHelp::showErrors($errors, 'issf_license_no') !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'license_valid_date') !!}">
                {!! Form::label('license_valid_date',__('messages.License_Valid_Date'), ['class' => 'bold']) !!} <span class="red">*</span>
                {!! Form::date('license_valid_date', null, array('class'=>'form-control', 'id'=>'license_valid_date', 'placeholder'=>__('messages.license_valid_date'), 'autocomplete'=>'off','required'=>'required')) !!}
                {!! APFrmErrHelp::showErrors($errors, 'license_valid_date') !!}
            </div>
        </div>


        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'date_of_birth') !!}">
                {!! Form::label('date_of_birth',__('messages.Date_Of_Birth'), ['class' => 'bold']) !!}
                {!! Form::date('date_of_birth', null, array('class'=>'form-control', 'id'=>'date_of_birth', 'placeholder'=>__('messages.date_of_birth'), 'autocomplete'=>'off')) !!}
                {!! APFrmErrHelp::showErrors($errors, 'date_of_birth') !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'jury_class') !!}">
                {!! Form::label('jury_class',__('messages.Jury_Class'), ['class' => 'bold']) !!}
                {!! Form::select('jury_class', ['' => __('messages.Choose_Class')]+$juryClass,null, array('class'=>'form-control jury_class', 'id'=>'jury_class')) !!}
                {!! APFrmErrHelp::showErrors($errors, 'jury_class') !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'address') !!}">
                {!! Form::label('address', __('messages.Address'), ['class' => 'bold']) !!}
                {!! Form::textarea('address', null, array('class'=>'form-control', 'id'=>'address', 'placeholder'=> __('messages.Address'), 'autocomplete'=>'off', 'rows'=>3)) !!}
                {!! APFrmErrHelp::showErrors($errors, 'address') !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'remark') !!}">
                {!! Form::label('remark',  __('messages.Remarks'), ['class' => 'bold']) !!}
                {!! Form::textarea('remark', null, array('class'=>'form-control', 'id'=>'remark', 'placeholder'=>__('messages.Remarks'), 'autocomplete'=>'off', 'rows'=>3)) !!}
                {!! APFrmErrHelp::showErrors($errors, 'remark') !!}
            </div>
        </div>


        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'remark') !!}">
                {!! Form::label('control',  __('messages.ChooseControl'), ['class' => 'bold']) !!}
                <ul class="optionlist" style="list-style: none; padding: 0;">
                    <li>
                        <input type="checkbox" name="rifle" id="rifle" {{isset($jury) && $jury->is_rifle==1 ? 'checked':''}} >
                        <label for="rifle">{{__('messages.Rifle')}}</label>
                    </li>
                    <li>
                        <input type="checkbox" name="pistol" id="pistol" {{isset($jury) && $jury->is_pistol==1 ? 'checked':''}}>
                        <label for="pistol">{{__('messages.Pistol')}}</label>
                    </li>
                    <li>
                        <input type="checkbox" name="short_gun" id="short_gun" {{isset($jury) && $jury->is_short_gun==1 ? 'checked':''}}>
                        <label for="short_gun">{{__('messages.Shortgun')}}</label>
                    </li>
                    <li>
                        <input type="checkbox" name="running_target" id="running_target" {{isset($jury) && $jury->is_running_target==1 ? 'checked':''}}>
                        <label for="running_target">{{__('messages.RunningTarget')}}</label>
                    </li>
                    <li>
                        <input type="checkbox" name="electronic_target" id="electronic_target" {{isset($jury) && $jury->is_electronic_target==1 ? 'checked':''}}>
                        <label for="electronic_target">{{__('messages.ElectronicTarget')}}</label>
                    </li>
                    <li>
                        <input type="checkbox" name="target_control" id="electronic_target" {{isset($jury) && $jury->is_target_control==1 ? 'checked':''}}>
                        <label for="electronic_target">{{__('messages.TargetControl')}}</label>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'e_signature') !!}">
                @if(isset($jury))
                    <input type="hidden" name="form_type" value="update">
                    {!! Form::label('e_signature', __('messages.E_Signature'), ['class' => 'bold']) !!} <span style="font-size: 10px">( {{__('messages.Profile_Image_size_270')}} )</span>
                    {!! Form::File('e_signature', array('class'=>'form-control', 'id'=>'e_signature')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'e_signature') !!}
                @else
                    <input type="hidden" name="form_type" value="insert">
                    {!! Form::label('e_signature', __('messages.E_Signature'), ['class' => 'bold']) !!}  <span style="font-size: 10px">( {{__('messages.Profile_Image_size_270')}})</span>
                    {!! Form::File('e_signature', array('class'=>'form-control', 'id'=>'e_signature')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'e_signature') !!}
                @endif
            </div>
        </div>




    </div>



                            <div class="row">
                                <div class="col-md-12">
                                    {!! Form::label('assign_event', __('messages.Assign_Events'), ['class' => 'bold']) !!}
{{--                                    {{dd($jury->juryEvent)}}--}}
                                    <table class="table table-striped table-bordered table-hover eventTable" id="eventTable">
                                        <tbody>
                                        @if(isset($jury))
                                            <tr>
                                                <td width="30%"></td>
                                                <td width="30%"></td>
                                                <td width="30%"></td>
                                                <td width="10%">
                                                    <span class="btn btn-primary" id="add_more_button" index_number="1"><i class="fas fa-plus-circle"></i> More</span>
                                                </td>
                                            </tr>
                                            @foreach($jury->juryEvent as $value)
                                                @php
                                                    if(app()->getLocale() == 'bn'){
                                                        $event_name = $value->event_name_bn;
                                                        $event_address = $value->event_address_bn;
                                                    }else{
                                                        $event_name = $value->event_name_en;
                                                        $event_address = $value->event_address_en;
                                                    }
                                                @endphp
                                            <tr row_number="{{$value->id.$value->jury_id}}" id="removeRow_{{$value->id.$value->jury_id}}">
                                            <td>
                                                <a class="displayNone" id="getEventNameRoute" data-href="{{ route('get_event_name') }}"></a>
                                                <input type="hidden" name="exists_event_id[]" value="{{$value->id}}">
                                                {!! Form::select('events[]', ['' => __('messages.Choose_Events')]+$events,$value && $value->event_id?$value->event_id:'others', array('class'=>'form-control events', 'required'=>'required')) !!}
                                            </td>
                                            <td>
                                                {!! Form::text('event_name[]',$event_name, array('class'=>'form-control event_name_0','placeholder'=>__('messages.Enter_Event_Name'), 'id'=>'event_name' )) !!}
                                            </td>
                                                <td>
                                                    {!! Form::textarea('event_address[]',$event_address, array('class'=>'form-control event_address','placeholder'=>__('messages.Event_Address'), 'id'=>'event_address', 'required'=>'required','rows'=>1)) !!}

                                                </td>

                                            <td>
                                                <button type="button" style="width:78px" class="btn btn-sm btn-outline-secondary" id="removeRow" rowID="{{$value->id.$value->jury_id}}"><i class="fa fa-times" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                            @endforeach

                                        @else
                                            <tr row_number="0" id="removeRow_0">
                                                <td>
                                                    <a class="displayNone" id="getEventNameRoute" data-href="{{ route('get_event_name') }}"></a>
                                                    {!! Form::select('events[]', ['' => __('messages.Choose_Events')]+$events,'', array('class'=>'form-control events', 'required'=>'required')) !!}
                                                </td>
                                                <td>
                                                    {!! Form::text('event_name[]',null, array('class'=>'form-control event_name_0','placeholder'=>__('messages.Enter_Event_Name'), 'id'=>'event_name', 'readonly'=>'true')) !!}
                                                </td>
                                                <td>
                                                    {!! Form::textarea('event_address[]',null, array('class'=>'form-control event_address','placeholder'=>__('messages.Event_Address'), 'id'=>'event_address', 'required'=>'required','rows'=>1)) !!}
                                                </td>

                                                <td>
                                                    <span class="btn btn-primary" id="add_more_button" index_number="1"><i class="fas fa-plus-circle"></i> {{__('messages.More')}}</span>
                                                </td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

        <div class="form-actions">
            {!! Form::button(__('messages.Save').' <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
        </div>
        <style>
            .red{
                color: red;
            }
        </style>
</div>
@push('scripts')

    <script>
        var index=1;
        $(document).delegate('#add_more_button','click',function () {
            $('#eventTable tbody').append('<tr row_number="'+index+'" id="removeRow_'+index+'"><td>{!! Form::select('events[]', ['' => __('messages.Choose_Events')]+$events,'', array('class'=>'form-control events','required'=>'required')) !!}</td><td>{!! Form::text('event_name[]',null, array('class'=>"form-control event_name",'placeholder'=>__('messages.Enter_Event_Name'), 'id'=>'event_name','readonly'=>'true')) !!}</td><td>{!! Form::textarea('event_address[]',null, array('class'=>'form-control event_address','placeholder'=>__('messages.Event_Address'), 'id'=>'event_address', 'required'=>'required','rows'=>1)) !!}</td><th width="10%"><button type="button" style="width:78px" class="btn btn-sm btn-outline-secondary" id="removeRow" rowID="'+index+'"><i class="fa fa-times" aria-hidden="true"></i></button></th></tr>');
            index++;
        });

        $(document).on('click', '#removeRow', function(){
            var button_id = $(this).attr("rowID");
            $('#removeRow_'+button_id+'').remove();
        });


        var eventTable = $('.eventTable');
        $(document).delegate('.events','change',function () {
            var element= $(this);
            var eventId = $(this).val();
            var index= $(element).closest('tr').attr('row_number');
            if(eventId == 'others'){
                $(this).closest('td').next('td').find('input:text').prop("readonly", false);
            }else{
                var url = $('#getEventNameRoute').attr('data-href');

                $.ajax({
                    url: url,
                    method: "GET",
                    dataType: "json",
                    data: {eventId: eventId},
                    beforeSend: function( xhr ) {

                    }
                }).done(function( response ) {
                    element.closest('td').next('td').find('input:text').val(response.event_name);
                }).fail(function( jqXHR, textStatus ) {

                });
                return false;
            }
        });
    </script>

@endpush
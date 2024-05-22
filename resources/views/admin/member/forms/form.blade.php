{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">
    @if(isset($member))
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ ImgUploader::print_image("committee_member/thumb/$member->profile_image") }}
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'name') !!}">
                {!! Form::label('name', 'Name', ['class' => 'bold']) !!} <span class="red">*</span>
                {!! Form::text('name', null, array('class'=>'form-control', 'id'=>'name', 'placeholder'=>'Name', 'autocomplete'=>'off', 'required'=>'required')) !!}
                {!! APFrmErrHelp::showErrors($errors, 'name') !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'profile_image') !!}">
                @if(isset($member))
                    <input type="hidden" name="form_type" value="update">
                    {!! Form::label('profile_image', 'Profile Image', ['class' => 'bold']) !!} <span style="font-size: 10px">( Greater than or equal to width 270px & height 270px. )</span>
                    {!! Form::File('profile_image', array('class'=>'form-control', 'id'=>'profile_image')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'profile_image') !!}
                @else
                    <input type="hidden" name="form_type" value="insert">
                    {!! Form::label('profile_image', 'Profile Image', ['class' => 'bold']) !!} <span class="red">*</span> <span style="font-size: 10px">( Greater than or equal to width 270px & height 270px. )</span>
                    {!! Form::File('profile_image', array('class'=>'form-control', 'id'=>'profile_image','required'=>'required')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'profile_image') !!}
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'mobile') !!}">
                {!! Form::label('mobile', 'Mobile Number', ['class' => 'bold']) !!} <span class="red">*</span>
                {!! Form::text('mobile', null, array('class'=>'form-control', 'id'=>'mobile', 'placeholder'=>'Mobile', 'autocomplete'=>'off','required'=>'required')) !!}
                {!! APFrmErrHelp::showErrors($errors, 'mobile') !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'email') !!}">
                {!! Form::label('email', 'Email', ['class' => 'bold']) !!} <span class="red">*</span>
                {!! Form::text('email', null, array('class'=>'form-control', 'id'=>'email', 'placeholder'=>'Email', 'autocomplete'=>'off','required'=>'required')) !!}
                {!! APFrmErrHelp::showErrors($errors, 'email') !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'facebook_link') !!}">
                {!! Form::label('facebook_link', 'Facebook Link', ['class' => 'bold']) !!}
                {!! Form::text('facebook_link', null, array('class'=>'form-control', 'id'=>'facebook_link', 'placeholder'=>'Facebook Link', 'autocomplete'=>'off')) !!}
                {!! APFrmErrHelp::showErrors($errors, 'facebook_link') !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'address') !!}">
                {!! Form::label('address', 'Address', ['class' => 'bold']) !!}
                {!! Form::textarea('address', null, array('class'=>'form-control', 'id'=>'address', 'placeholder'=>'Address', 'autocomplete'=>'off', 'rows'=>3)) !!}
                {!! APFrmErrHelp::showErrors($errors, 'address') !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'short_message') !!}">
                {!! Form::label('short_message', 'Short Message', ['class' => 'bold']) !!}
                {!! Form::textarea('short_message', null, array('class'=>'form-control', 'id'=>'short_message', 'placeholder'=>'Short Message', 'autocomplete'=>'off', 'rows'=>3)) !!}
                {!! APFrmErrHelp::showErrors($errors, 'short_message') !!}
            </div>
        </div>
    </div>



        <div class="row">
            <div class="col-md-12">
                {!! Form::label('short_message', 'Assign committee wise designation', ['class' => 'bold']) !!}
                <table class="table table-striped table-bordered table-hover committeeTable" id="commiteeTable">
                    <tbody>
                    @if(isset($member))
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="btn btn-primary" id="add_more_button" index_number="1"><i class="fas fa-plus-circle"></i> More</span>
                            </td>
                        </tr>
                        @foreach($member->memberDesignation as $memberDesig)
                        <tr row_number="{{$memberDesig->id.$memberDesig->designation_id}}" id="removeRow_{{$memberDesig->id.$memberDesig->designation_id}}">
                        <td>
                            <a class="displayNone" id="designationDropdownRoute"
                               data-href="{{ route('create_designation_dropdown',app()->getLocale()) }}">
                            </a>
                            @php
                                $committeeType = $memberDesig->committee_type;
                                    if ($memberDesig->committee_type != 'EXECUTIVE_COMMITTEE' && $memberDesig->committee_type != 'CAMP_COMMANDANT_COACH' && $memberDesig->committee_type != 'OFFICE_ADMINISTRATION'){
                                        $committeeType = $memberDesig->sub_committee_group;
                                    }
                                    $designations = App\Helpers\DataArrayHelper::langCareerLevelsArrayByCommitteeType($committeeType);
                            @endphp
                            {!! Form::select('committee_type[]', ['' => 'Select Committee']+$CommitteeGroups,$committeeType?$committeeType:'', array('class'=>'form-control committee_type', 'id'=>'committee_type_1', 'required'=>'required')) !!}
                        </td>
                        <td>
                            {!! Form::select('designation_id[]', ['' => 'Select Designation']+$designations,isset($memberDesig)&&$memberDesig->designation_id?$memberDesig->designation_id:'', array('class'=>'form-control designation', 'id'=>'designation_id', 'required'=>'required')) !!}
                        </td>

                        <td>
                            <button type="button" style="width:78px" class="btn btn-sm btn-outline-secondary" id="removeRow" rowID="{{$memberDesig->id.$memberDesig->designation_id}}"><i class="fa fa-times" aria-hidden="true"></i></button>
                        </td>
                    </tr>
                        @endforeach

                    @else
                        <tr row_number="0" id="removeRow_0">
                            <td>
                                <a class="displayNone" id="designationDropdownRoute"
                                   data-href="{{ route('create_designation_dropdown',app()->getLocale()) }}">
                                </a>
                                {!! Form::select('committee_type[]', ['' => 'Select Committee']+$CommitteeGroups, isset($executiveMember)&&$executiveMember->designation_id?$executiveMember->designation_id:'', array('class'=>'form-control committee_type', 'id'=>'committee_type_1', 'required'=>'required')) !!}
                            </td>
                            <td>
                                {!! Form::select('designation_id[]', ['' => 'Select Designation'],null, array('class'=>'form-control designation', 'id'=>'designation_id', 'required'=>'required')) !!}
                            </td>

                            <td>
                                <span class="btn btn-primary" id="add_more_button" index_number="1"><i class="fas fa-plus-circle"></i> More</span>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="form-actions">
            {!! Form::button('Save <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
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

            $('#commiteeTable tbody').append('<tr row_number="'+index+'" id="removeRow_'+index+'"><td>{!! Form::select('committee_type[]', ['' => 'Select Committee']+$CommitteeGroups,null, array('class'=>'form-control committee_type', 'id'=>'committee_type_', 'required'=>'required')) !!}</td><td>{!! Form::select('designation_id[]', ['' => 'Select Designation'],null, array('class'=>'form-control designation', 'id'=>'designation_id_', 'required'=>'required')) !!}</td><th width="10%"><button type="button" style="width:78px" class="btn btn-sm btn-outline-secondary" id="removeRow" rowID="'+index+'"><i class="fa fa-times" aria-hidden="true"></i></button></th></tr>');
            index++;
        });

        $(document).on('click', '#removeRow', function(){
            var button_id = $(this).attr("rowID");
            $('#removeRow_'+button_id+'').remove();
        });

        var committeeTable= $('.committeeTable');
        $(document).delegate('.committee_type','change',function () {
            var element= $(this);
            var committeeType = $(this).val();
            var index= $(element).closest('tr').attr('row_number');

            if(committeeTypeDuplicateCheck(committeeTable, committeeType, index)){
                alert($(this).find(":selected").text()+' is already exits.');
                $(this).val("").focus();
                return false;
            }

            var url = $('#designationDropdownRoute').attr('data-href');

            $.ajax({
                url: url,
                method: "GET",
                dataType: "json",
                data: {committeeType: committeeType},
                beforeSend: function( xhr ) {

                }
            }).done(function( response ) {
                var designationDataOption = '';
                var designationDataOption='<option value="">Select Designation</option>';
                jQuery.each(response, function(i, item) {
                    designationDataOption += '<option value="'+i+'">'+item+'</option>';
                });
                jQuery(element).closest('tr').find('.designation').html(designationDataOption);
            }).fail(function( jqXHR, textStatus ) {

            });
            return false;

        });

        function committeeTypeDuplicateCheck(eachElement, item, index) {
            var found = false;
            $(eachElement).find('tbody tr').not('#removeRow_'+index).each(function (i, el) {
                if(item==$(el).find('.committee_type').val()){
                    found=true;
                    return false;
                }
            });

            return found;

        }
    </script>

{{--@include('admin.shared.tinyMCE')--}}
@endpush
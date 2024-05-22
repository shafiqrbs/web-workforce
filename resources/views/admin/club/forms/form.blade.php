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
    @if(isset($club))
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ ImgUploader::print_image("club/thumb/$club->club_logo") }}
                </div>
            </div>
        </div>
        <input type="hidden" name="form_type" value="update">
    @else
        <input type="hidden" name="form_type" value="insert">
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'name') !!}">
                {!! Form::label('name', __('messages.Name'), ['class' => 'bold']) !!} <span class="red">*</span>
                {!! Form::text('name', null, array('class'=>'form-control', 'id'=>'name', 'placeholder'=>__('messages.Name'), 'autocomplete'=>'off', 'required'=>'required')) !!}
                {!! APFrmErrHelp::showErrors($errors, 'faq_question') !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'club_logo') !!}">
                @if(isset($club))
                    {!! Form::label('club_logo', __('messages.Club_Logo'), ['class' => 'bold']) !!} <span style="font-size: 10px">( {{__('messages.Profile_Image_size_270')}} )</span>
                    {!! Form::File('club_logo', array('class'=>'form-control', 'id'=>'club_logo')) !!}
                @else
                    {!! Form::label('club_logo', __('messages.Club_Logo'), ['class' => 'bold']) !!}<span class="red">*</span> <span style="font-size: 10px">( {{__('messages.Profile_Image_size_270')}} )</span>
                    {!! Form::File('club_logo', array('class'=>'form-control', 'id'=>'club_logo','required'=>'required')) !!}
                @endif
                {!! APFrmErrHelp::showErrors($errors, 'club_logo') !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'registration_number') !!}">
                {!! Form::label('registration_number', __('messages.Reg_Number'), ['class' => 'bold']) !!} <span class="red">*</span>
                {!! Form::text('registration_number', null, array('class'=>'form-control', 'id'=>'registration_number', 'placeholder'=> __('messages.Reg_Number'), 'autocomplete'=>'off', 'required'=>'required')) !!}
                {!! APFrmErrHelp::showErrors($errors, 'registration_number') !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'mobile') !!}">
                {!! Form::label('mobile', __('messages.Mobile_Number'), ['class' => 'bold']) !!} <span class="red">*</span>
                {!! Form::text('mobile', null, array('class'=>'form-control', 'id'=>'mobile', 'placeholder'=>__('messages.Mobile_Number'), 'autocomplete'=>'off','required'=>'required')) !!}
                {!! APFrmErrHelp::showErrors($errors, 'mobile') !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'email') !!}">
                {!! Form::label('email', __('messages.Email'), ['class' => 'bold']) !!} <span class="red">*</span>
                {!! Form::text('email', null, array('class'=>'form-control', 'id'=>'email', 'placeholder'=>__('messages.Email'), 'autocomplete'=>'off','required'=>'required')) !!}
                {!! APFrmErrHelp::showErrors($errors, 'email') !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'address') !!}">
                {!! Form::label('address', __('messages.Address'), ['class' => 'bold']) !!}
                {!! Form::text('address', null, array('class'=>'form-control', 'id'=>'address', 'placeholder'=>__('messages.Address'), 'autocomplete'=>'off')) !!}
                {!! APFrmErrHelp::showErrors($errors, 'address') !!}
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'division_id') !!}">
                {!! Form::label('division_id',__('messages.Division'), ['class' => 'bold']) !!} <span class="red">*</span>
                {!! Form::select('division_id', ['' => __('messages.Choose_Division')]+$divisions, isset($club)&&$club->division_id?$club->division_id:'', array('class'=>'form-control', 'id'=>'division_id','required'=>'required')) !!}
                <a data-href ="{{route('district_dropdown_route',app()->getLocale())}}" id="districtRoute"></a>
                {!! APFrmErrHelp::showErrors($errors, 'division_id') !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'district_id') !!}">
                {!! Form::label('district_id', __('messages.District'), ['class' => 'bold']) !!} <span class="red">*</span>
                {!! Form::select('district_id', ['' => __('messages.Choose_District')]+$cities, isset($club)&&$club->district_id?$club->district_id:'', array('class'=>'form-control', 'id'=>'district_id','required'=>'required')) !!}
                {!! APFrmErrHelp::showErrors($errors, 'district_id') !!}
            </div>
        </div>
    </div>

        <div class="row">

            <div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'club_type') !!}">
                    {!! Form::label('club_type', __('messages.Club_Type'), ['class' => 'bold']) !!}
                    {!! Form::select('club_type', $clubTypes, isset($club) && array_key_exists($club->club_type, $clubTypes) ?$club->club_type:'', array('class'=>'form-control', 'id'=>'club_type')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'club_type') !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'short_name') !!}">
                    {!! Form::label('short_name', __('messages.Short_Name'), ['class' => 'bold']) !!} <span class="red">*</span>
                    {!! Form::text('short_name', null, array('class'=>'form-control', 'id'=>'short_name', 'placeholder'=>__('messages.Short_Name'), 'autocomplete'=>'off', 'required'=>'required')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'short_name') !!}
                </div>
            </div>


            {{--<div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'division_id') !!}">
                    {!! Form::label('is_active', 'Status', ['class' => 'bold']) !!}
                    {!! Form::select('is_active',$status,isset($club)&&$club->is_active?$club->is_active:'', array('class'=>'form-control', 'id'=>'is_active')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'is_active') !!}
                </div>
            </div>--}}
        </div>


        <div class="row">

            <div class="col-md-12">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'about_club') !!}">
                    {!! Form::label('about_club', __('messages.About_Club'), ['class' => 'bold']) !!}
                    {!! Form::textarea('about_club', null, array('class'=>'form-control', 'id'=>'about_club', 'placeholder'=>__('messages.About_Club'), 'autocomplete'=>'off')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'about_club') !!}
                </div>
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

    $(document).delegate('#division_id','change',function () {
        var divisionID = $(this).val();
        var url = $('#districtRoute').attr('data-href');


        $.ajax({
            url: url,
            method: "GET",
            dataType: "json",
            data: {divisionID: divisionID},
            beforeSend: function( xhr ) {

            }
        }).done(function( response ) {
            if(response.status == 200){
                var allItems = response.district;
                var districtDataOption = '';
                var districtDataOption='<option value="">Choose District</option>';
                jQuery.each(allItems, function(i, item) {
                    districtDataOption += '<option value="'+i+'">'+item+'</option>';
                });
                jQuery('#district_id').html(districtDataOption);
                jQuery('#district_id').prop('disabled', false);
            }else{
                var districtDataOption = '';
                var districtDataOption='<option value="">Choose District</option>';
                alert('District not found');
                jQuery('#district_id').html(districtDataOption);
                jQuery('#district_id').prop('disabled', false);
            }

        }).fail(function( jqXHR, textStatus ) {

        });
        return false;
    });
</script>
@include('admin.shared.tinyMCE')
@endpush
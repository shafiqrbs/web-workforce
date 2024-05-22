{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">
    @if(isset($financialPartner)&&$financialPartner->profile_image)
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ ImgUploader::print_image("financial_partner/thumb/$financialPartner->profile_image") }}
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'name') !!}">
                {!! Form::label('name', 'Name', ['class' => 'bold']) !!} <span class="red">*</span>
                {!! Form::text('name', null, array('class'=>'form-control', 'id'=>'name', 'placeholder'=>'Name', 'autocomplete'=>'off', 'required'=>'required')) !!}
                {!! APFrmErrHelp::showErrors($errors, 'faq_question') !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'profile_image') !!}">
                @if(isset($financialPartner))
                    <input type="hidden" name="form_type" value="update">
                    {!! Form::label('profile_image', 'Profile Image', ['class' => 'bold']) !!} <span style="font-size: 10px">( Greater than or equal to width 200px & height 150px. )</span>
                    {!! Form::File('profile_image', array('class'=>'form-control', 'id'=>'profile_image')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'profile_image') !!}
                @else
                    <input type="hidden" name="form_type" value="insert">
                    {!! Form::label('profile_image', 'Profile Image', ['class' => 'bold']) !!} <span class="red">*</span> <span style="font-size: 10px">( Greater than or equal to width 200px & height 150px. )</span>
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
            <div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'facebook_link') !!}">
                    {!! Form::label('facebook_link', 'Web URL', ['class' => 'bold']) !!}
                    {!! Form::text('facebook_link', null, array('class'=>'form-control', 'id'=>'facebook_link', 'placeholder'=>'Web URL', 'autocomplete'=>'off')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'facebook_link') !!}
                </div>
            </div>
            {{--<div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'division_id') !!}">
                    {!! Form::label('is_active', 'Status', ['class' => 'bold']) !!}
                    {!! Form::select('is_active',$status,isset($financialPartner)?$financialPartner->is_active:0, array('class'=>'form-control', 'id'=>'is_active')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'is_active') !!}
                </div>
            </div>--}}
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

{{--@include('admin.shared.tinyMCE')--}}
@endpush
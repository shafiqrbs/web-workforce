{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">
    @if(isset($arms))
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
{{--                    {{ ImgUploader::print_image("arms/thumb/$arms->arms_image") }}--}}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ ImgUploader::print_image("arms/thumb/$arms->arms_image") }}
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
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'arms_image') !!}">
                @if(isset($arms))
                    <input type="hidden" name="form_type" value="update">
                    {!! Form::label('arms_image', __('messages.arms_image'), ['class' => 'bold']) !!} <span style="font-size: 10px">( {{__('messages.Profile_Image_size_270')}} )</span>
                    {!! Form::File('arms_image', array('class'=>'form-control', 'id'=>'arms_image')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'arms_image') !!}
                @else
                    <input type="hidden" name="form_type" value="insert">
                    {!! Form::label('arms_image', __('messages.arms_image'), ['class' => 'bold']) !!} <span class="red">*</span> <span style="font-size: 10px">( {{__('messages.Profile_Image_size_270')}})</span>
                    {!! Form::File('arms_image', array('class'=>'form-control', 'id'=>'arms_image','required'=>'required')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'arms_image') !!}
                @endif
            </div>
        </div>
    </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'bullet_size') !!}">
                    {!! Form::label('bullet_size', __('messages.bullet_size'), ['class' => 'bold']) !!} <span class="red">*</span>
                    {!! Form::text('bullet_size', null, array('class'=>'form-control', 'id'=>'bullet_size', 'placeholder'=> __('messages.bullet_size'), 'autocomplete'=>'off','required'=>'required')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'bullet_size') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'quantity') !!}">
                    {!! Form::label('quantity', __('messages.quantity'), ['class' => 'bold']) !!} <span class="red">*</span>
                    {!! Form::text('quantity', null, array('class'=>'form-control', 'id'=>'quantity', 'placeholder'=>__('messages.quantity'), 'autocomplete'=>'off','required'=>'required')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'quantity') !!}
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'max_velocity') !!}">
                    {!! Form::label('max_velocity',__('messages.max_velocity'), ['class' => 'bold']) !!}
                    {!! Form::text('max_velocity', null, array('class'=>'form-control', 'id'=>'max_velocity', 'placeholder'=>__('messages.max_velocity'), 'autocomplete'=>'off')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'max_velocity') !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'overall_length') !!}">
                    {!! Form::label('overall_length',__('messages.overall_length'), ['class' => 'bold']) !!}
                    {!! Form::text('overall_length', null, array('class'=>'form-control', 'id'=>'overall_length', 'placeholder'=>__('messages.overall_length'), 'autocomplete'=>'off')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'overall_length') !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'buttplate') !!}">
                    {!! Form::label('buttplate',__('messages.buttplate'), ['class' => 'bold']) !!}
                    {!! Form::text('buttplate', null, array('class'=>'form-control', 'id'=>'buttplate', 'placeholder'=>__('messages.buttplate'), 'autocomplete'=>'off')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'buttplate') !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'function') !!}">
                    {!! Form::label('function',__('messages.function'), ['class' => 'bold']) !!}
                    {!! Form::text('function', null, array('class'=>'form-control', 'id'=>'function', 'placeholder'=>__('messages.function'), 'autocomplete'=>'off')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'function') !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'weight') !!}">
                    {!! Form::label('weight',__('messages.weight'), ['class' => 'bold']) !!}
                    {!! Form::text('weight', null, array('class'=>'form-control', 'id'=>'weight', 'placeholder'=>__('messages.weight'), 'autocomplete'=>'off')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'weight') !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'trigger_pull') !!}">
                    {!! Form::label('trigger_pull',__('messages.trigger_pull'), ['class' => 'bold']) !!}
                    {!! Form::text('trigger_pull', null, array('class'=>'form-control', 'id'=>'trigger_pull', 'placeholder'=>__('messages.trigger_pull'), 'autocomplete'=>'off')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'trigger_pull') !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'scopeable') !!}">
                    {!! Form::label('scopeable',__('messages.scopeable'), ['class' => 'bold']) !!}
                    {!! Form::select('scopeable', ['' => __('messages.Choose_Scopeable')]+$scopeable,null, array('class'=>'form-control scopeable', 'id'=>'scopeable')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'scopeable') !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'safety') !!}">
                    {!! Form::label('safety',__('messages.safety'), ['class' => 'bold']) !!}
                    {!! Form::select('safety', ['' => __('messages.Choose_safety')]+$scopeable,null, array('class'=>'form-control safety', 'id'=>'safety')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'scopeable') !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'suggested_for') !!}">
                    {!! Form::label('suggested_for',__('messages.suggested_for'), ['class' => 'bold']) !!}
                    {!! Form::text('suggested_for', null, array('class'=>'form-control', 'id'=>'suggested_for', 'placeholder'=>__('messages.suggested_for'), 'autocomplete'=>'off')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'suggested_for') !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'Caliber') !!}">
                    {!! Form::label('Caliber',__('messages.Caliber'), ['class' => 'bold']) !!}
                    {!! Form::text('caliber', null, array('class'=>'form-control', 'id'=>'Caliber', 'placeholder'=>__('messages.Caliber'), 'autocomplete'=>'off')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'Caliber') !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'muzzle_energy') !!}">
                    {!! Form::label('muzzle_energy',__('messages.muzzle_energy'), ['class' => 'bold']) !!}
                    {!! Form::text('muzzle_energy', null, array('class'=>'form-control', 'id'=>'muzzle_energy', 'placeholder'=>__('messages.muzzle_energy'), 'autocomplete'=>'off')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'muzzle_energy') !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'loudness') !!}">
                    {!! Form::label('loudness',__('messages.loudness'), ['class' => 'bold']) !!}
                    {!! Form::text('loudness', null, array('class'=>'form-control', 'id'=>'loudness', 'placeholder'=>__('messages.loudness'), 'autocomplete'=>'off')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'loudness') !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'barrel_length') !!}">
                    {!! Form::label('barrel_length',__('messages.barrel_length'), ['class' => 'bold']) !!}
                    {!! Form::text('barrel_length', null, array('class'=>'form-control', 'id'=>'barrel_length', 'placeholder'=>__('messages.barrel_length'), 'autocomplete'=>'off')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'barrel_length') !!}
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'barrel') !!}">
                    {!! Form::label('barrel',__('messages.barrel'), ['class' => 'bold']) !!}
                    {!! Form::text('barrel', null, array('class'=>'form-control', 'id'=>'barrel', 'placeholder'=>__('messages.barrel'), 'autocomplete'=>'off')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'barrel') !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'front_sight') !!}">
                    {!! Form::label('front_sight',__('messages.front_sight'), ['class' => 'bold']) !!}
                    {!! Form::text('front_sight', null, array('class'=>'form-control', 'id'=>'front_sight', 'placeholder'=>__('messages.front_sight'), 'autocomplete'=>'off')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'front_sight') !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'rear_sight') !!}">
                    {!! Form::label('rear_sight',__('messages.rear_sight'), ['class' => 'bold']) !!}
                    {!! Form::text('rear_sight', null, array('class'=>'form-control', 'id'=>'rear_sight', 'placeholder'=>__('messages.rear_sight'), 'autocomplete'=>'off')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'rear_sight') !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'trigger') !!}">
                    {!! Form::label('trigger',__('messages.trigger'), ['class' => 'bold']) !!}
                    {!! Form::text('trigger', null, array('class'=>'form-control', 'id'=>'trigger', 'placeholder'=>__('messages.trigger'), 'autocomplete'=>'off')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'trigger') !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'action') !!}">
                    {!! Form::label('action',__('messages.Actions'), ['class' => 'bold']) !!}
                    {!! Form::text('action', null, array('class'=>'form-control', 'id'=>'action', 'placeholder'=>__('messages.Actions'), 'autocomplete'=>'off')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'action') !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'power_plant') !!}">
                    {!! Form::label('power_plant',__('messages.power_plant'), ['class' => 'bold']) !!}
                    {!! Form::text('power_plant', null, array('class'=>'form-control', 'id'=>'power_plant', 'placeholder'=>__('messages.power_plant'), 'autocomplete'=>'off')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'power_plant') !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'max_shots_per_fill') !!}">
                    {!! Form::label('max_shots_per_fill',__('messages.max_shots_per_fill'), ['class' => 'bold']) !!}
                    {!! Form::text('max_shots_per_fill', null, array('class'=>'form-control', 'id'=>'max_shots_per_fill', 'placeholder'=>__('messages.max_shots_per_fill'), 'autocomplete'=>'off')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'max_shots_per_fill') !!}
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'operating_pressuer') !!}">
                    {!! Form::label('operating_pressuer',__('messages.operating_pressuer'), ['class' => 'bold']) !!}
                    {!! Form::text('operating_pressuer', null, array('class'=>'form-control', 'id'=>'operating_pressuer', 'placeholder'=>__('messages.operating_pressuer'), 'autocomplete'=>'off')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'operating_pressuer') !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'body_type') !!}">
                    {!! Form::label('body_type',__('messages.body_type'), ['class' => 'bold']) !!}
                    {!! Form::select('body_type', ['' => __('messages.choose_body_type')]+$bodyType,null, array('class'=>'form-control body_type', 'id'=>'body_type')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'body_type') !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'fixed_adj_power') !!}">
                    {!! Form::label('fixed_adj_power',__('messages.fixed_adj_power'), ['class' => 'bold']) !!}
                    {!! Form::select('fixed_adj_power', ['' => __('messages.choose_fixed_adj_power')]+$bodyPower,null, array('class'=>'form-control fixed_adj_power select2', 'id'=>'fixed_adj_power')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'fixed_adj_power') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'shot_capacity') !!}">
                    {!! Form::label('shot_capacity',__('messages.shot_capacity'), ['class' => 'bold']) !!}
                    {!! Form::select('shot_capacity', ['' => __('messages.choose_shot_capacity')]+$shotCapacity,null, array('class'=>'form-control shot_capacity select2', 'id'=>'shot_capacity')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'shot_capacity') !!}
                </div>
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


@endpush
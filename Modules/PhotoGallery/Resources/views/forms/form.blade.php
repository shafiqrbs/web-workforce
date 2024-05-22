
{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'name') !!}">
                {!! Form::label('name', 'Name', ['class' => 'bold']) !!} <span class="red">*</span>
                {!! Form::text('name', $photoGallery->name?$photoGallery->name:old('name'), array('class'=>'form-control', 'id'=>'name', 'placeholder'=>'Name', 'required'=>'required')) !!}
            </div>


            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'year') !!}">
                {!! Form::label('year', 'Year', ['class' => 'bold']) !!} <span class="red">*</span>
                {!! Form::select('year', ['' => 'Select Year']+$photoYear, isset($photoGallery)&&$photoGallery->year?$photoGallery->year:date("Y"), array('class'=>'form-control', 'id'=>'year','required'=>'required')) !!}
            </div>


            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'cover_image') !!}">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"> <img src="{{ asset('/') }}admin_assets/no-image.png" alt="" /> </div>

                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                            <div> <span class="btn default btn-file"> <span class="fileinput-new"> Cover Image </span>  <span class="fileinput-exists"> Change </span> {!! Form::file('cover_image', null, array('id'=>'cover_image')) !!} </span> <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>  <span style="font-size: 10px;width: 266px;display: block;">( Greater than or equal to width 1920px & height 700px. )</span>
                            </div>
                        </div>
                        {!! APFrmErrHelp::showErrors($errors, 'cover_image') !!} </div>
                </div>

            @if(isset($photoGallery) && $photoGallery->cover_image)
                    <div class="col-md-6" style="text-align: right">
                        {{ ImgUploader::print_image("photo_gallery/thumb/$photoGallery->cover_image", 100, 150) }}
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {!! APFrmErrHelp::hasError($errors, 'description') !!}">
                {!! Form::label('description', 'Description', ['class' => 'bold']) !!}
                {!! Form::textarea('description', $photoGallery->description?$photoGallery->description:old('name'), array('class'=>'form-control', 'id'=>'description', 'placeholder'=>'Description')) !!}
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <td>Image</td>
                    <td>Caption</td>
                    <td>Action</td>
                </tr>
                <tr>
                    <td>
{{--                        <input type="file" id="file" name="file" class="form-control" />--}}
                        <input type="file" id="file" name="file[]" class="form-control" multiple />
                        <span style="font-size: 10px;">( Greater than or equal to width 1280px & height 850px. )</span>
                    </td>
                    <td>
                        {!! Form::text('caption', null, array('class'=>'form-control caption', 'id'=>'caption', 'placeholder'=>'Caption')) !!}
                    </td>
                    <td>
                        <button id="photo_gallery_image_add" type="button" data-action="" data-entity-id="{{$photoGallery->id}}" class="btn btn-primary btn-sm">Add</button>
                    </td>
                </tr>
                </thead>
                <tbody class="photo_gallery_images">
                @include('photogallery::partial/photo_gallery_images')
                </tbody>
            </table>
        </div>
    </div>

    <div class="form-actions">
        {!! Form::button('Update <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
    </div>
</div>
@push('scripts')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#photo_gallery_image_add').on('click',function(e) {
        var fd = new FormData();
        var caption=$('#caption').val();
        var id=$(this).attr('data-entity-id');

        let TotalFiles = $('#file')[0].files.length; //Total files
        let files = $('#file')[0];
        for (let i = 0; i < TotalFiles; i++) {
            fd.append('files' + i, files.files[i]);
        }
        fd.append('TotalFiles', TotalFiles);

        if(TotalFiles > 0 ){
            fd.append('id',id);
            fd.append('caption',caption);
            fd.append("_token", '{{csrf_token()}}');
            $.ajax({
                url: '{!! route('store_photo_gallery_image') !!}',
                headers:{'X-CSRF-Token':$('meta[name=csrf_token]').attr('content')},
                async:true,
                type:"post",
                contentType:false,
                data:fd,
                processData:false,
                success: function(response){
                    jQuery(".photo_gallery_images").html(response.html);
                },
            });
        }else{
            alert("Please select a file.");
        }
    });

    $(document).on('click','.record_delete',function(e) {
        var element= $(this);
        var entityId= $(this).attr('data-id');
        if(entityId==''){
            alert('This record are not available');
            return false;
        }
        if(confirm('Are you sure delete?')){
            jQuery.ajax({
                type: 'GET',
                dataType: 'json',
                url: '/admin/photo-gallery/ajax/photo-gallery-image/delete/' + entityId,
                data: {},
                success: function (data) {

                    if (data.status == 200) {
                        jQuery('.alert').addClass('alert-success').show().html(data.message);
                    }
                    $(element).closest('tr').remove();
                }

            });
        }
    });
</script>
@endpush
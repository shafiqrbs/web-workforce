<tr sl-no="{{$sl_no}}" id="delete_row_{{$sl_no}}">
    <td>
        <input type="file" id="file" name="file[]" class="form-control" accept="application/pdf" multiple />
    </td>
    <td>
        {!! Form::text('caption[]', null, array('class'=>'form-control caption', 'id'=>'caption', 'placeholder'=>'Caption')) !!}
    </td>
    <td  class="text-center">
        <button id="delete_click" type="button" id="delete_click" class="btn btn-danger btn-sm" sl_no={{$sl_no}}>Delete</button>
    </td>
</tr>
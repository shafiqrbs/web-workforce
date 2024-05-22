
@if(count($attachment)>0)
    @php $i=1 @endphp
    @foreach($attachment as $attach)
        <tr>
            <th scope="row">{{$i}}</th>
            <td>
                <a href="{{ route('archive_multiple_download_front',$attach->id) }}">{{$attach->attachment}}</a>
            </td>
            <td>{{$attach->caption}}</td>
            <td>
                <a href="{{ route('archive_multiple_download_front',$attach->id) }}">
                    {!! Form::label('Download','Download', ['class' => 'bold','style'=>'cursor: pointer;background: #dfdddd;padding: 5px 5px;','title'=>'Download']) !!}
                </a>
            </td>
        </tr>
        @php $i++ @endphp
    @endforeach
@endif
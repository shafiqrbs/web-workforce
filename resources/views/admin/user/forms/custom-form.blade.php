<div class="row">
    <div class="col-md-10">
        <form class="form-horizontal" method="POST" action="{{ route('updateUser') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $user->id }}">
            <div class="formrow{{ $errors->has('first_name') ? ' has-error' : '' }}">
                <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}">
                @if ($errors->has('first_name'))
                    <span class="help-block"> <strong>{{ $errors->first('first_name *') }}</strong> </span>
                @endif
            </div>
            <button class="btn btn-primary mt-5" type="submit">Update Profile</button>
        </form>
    </div>
</div>
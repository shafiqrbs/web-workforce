<div class="profile-boxs">
    {{--<div class="single-box sky">
        <div class="active-btn"></div>
        <h2>Active</h2>
        <p>Account Status</p>
    </div>--}}



    <div class="single-box sky">
        <div class="active-btn"></div>
        <h2>
            @if($athleteData->is_active == 1 && $athleteData->is_approved == 1)
            {{'Active'}}
            @else
            {{'Inactive'}}
                @endif
        </h2>
        <p>Account Status</p>
    </div>

    {{--<div class="single-box sky">
        <div class="active-btn"></div>
        <h2>Active</h2>
        <p>Account Status</p>
    </div>--}}
    {{--<div class="single-box gray">
        <img src="assets/images/eye.png" alt="">
        @php
            use Carbon\Carbon ;

                $now = Carbon::now();
                $endDate = Auth::user()->package_end_date;
                $end = Carbon::parse($endDate);
                $leftDate = $now->diffInDays($end);
        @endphp
        <p>Access (days remaining)</p>

        <h2>{{$leftDate}}</h2>
        <p>Expiry Date: </p>
        <p> {{ date('M d, Y', strtotime($endDate)) }}</p>
    </div>--}}
   {{-- <div class="single-box yellow">
        <img src="assets/images/profile.png" alt="">
        <h2>{{Auth::user()->profile_visibility==1?'Public':'Private'}}</h2>
        <p>Profile Visibility</p>
    </div>--}}
    {{--<div class="single-box white">
        <img src="assets/images/doc.png" alt="">
        <h2>{{Auth::user()->countProfileCvs()>0?'Yes':'No'}}</h2>
        <p>Resume Uploaded</p>
    </div>--}}
    {{--<div class="single-box green">
        <img src="assets/images/youtube.png" alt="">
        @if(isset($userProfileVideo))
            @if($userProfileVideo->status == 'approved')
                <p>{{__('Video Approved')}}</p>
            @elseif($userProfileVideo->status == 'notapproved')
                <p>{{__('Video Not Approved')}}</p>
            @elseif($userProfileVideo->status == 'submitted_for_approval')
               <p>{{__('Video Submitted for Approval')}}</p>
            @elseif($userProfileVideo->status == 'created')
                <h2>Yes</h2>
                <p>Video Uploaded</p>
            @endif
        @else
            <h2>No</h2>
            <p>Video Uploaded</p>
        @endif
    </div>--}}
</div>

<div class="profile-boxs">
    <div class="single-box sky">
        <div class="active-btn"></div>
        <h2>Active</h2>
        <p>Account Status</p>
    </div>
    <div class="single-box gray">
        <img src="assets/images/eye.png" alt="">
        <h2>{{Auth::user()->num_profile_views}}</h2>
        <p>Profile Views</p>
    </div>
    <div class="single-box yellow">
        <img src="assets/images/profile.png" alt="">
        <h2>{{Auth::user()->profile_visibility==1?'Public':'Private'}}</h2>
        <p>Profile Visibility</p>
    </div>
    <div class="single-box white">
        <img src="assets/images/doc.png" alt="">
        <h2>{{Auth::user()->countProfileCvs()>0?'Yes':'No'}}</h2>
        <p>Resume Uploaded</p>
    </div>
    <div class="single-box green">
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
    </div>
</div>

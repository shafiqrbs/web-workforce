@extends('layouts.app')
@section('content')
    <!-- Header start -->
    @include('includes.header')
    <!-- Header end -->

    @include('includes.employer_tab')

    <section id="dashboard">
        <div class="container">
            <div class="imr">
                <div class="im-12">
                    <div class="dashboard-inner">
                        @include('includes.subAccount_dashboard_menu')

                        <div class="dashboard-tab-content">
                            <div class="profile-main">
                                <div class="jobseeker-inner" style="padding:35px;">

                                    <p>Click on the <i class="fa fa-heart"></i> to delete profiles</p>

                                    @foreach($savedJobseekerPofiles as $savedJobseekerPofile)
                                        @if($savedJobseekerPofile->userId)
                                        <div class="show-profile">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="profile-img">
                                                        @php
                                                            $image = (!empty($savedJobseekerPofile->image)) ? $savedJobseekerPofile->image : 'no-no-image.gif';
                                                            $printImage= \ImgUploader::print_image("user_images/$image", '/admin_assets/no-image.png', $savedJobseekerPofile->name);

                                                        @endphp
                                                        {{$printImage}}
                                                    </div>

                                                    <a href="javascript:void(0)" data-id="{{$savedJobseekerPofile->id}}" class="favourite_jobseeker_remove"><i class="fa fa-heart top-right-love"></i></a>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="profile-info" style="padding-bottom: 10px;">
                                                                <h4>{{ $savedJobseekerPofile->name }}</h4>

                                                                @php
                                                                    $userJobTitles = DB::table('user_job_titles')
                ->join('job_titles', 'job_titles.id', '=', 'user_job_titles.job_title_id')
                ->where('user_id',$savedJobseekerPofile->userId)->get();
                                                                @endphp

                                                               @foreach($userJobTitles as $item)
                                                                    <p style="margin-bottom: 0px; display:inline-block;">{{ $item->job_title }}@if(!$loop->last),@endif</p>

                                                                @endforeach



                                                                @if($savedJobseekerPofile->other_job_title)
                                                                    <p style="margin-bottom: 0rem;"> {{$savedJobseekerPofile->other_job_title}}</p>
                                                                @endif

                                                                {{--@if ($savedJobseekerPofile->other_job_title)
                                                                    @foreach(explode(',', $savedJobseekerPofile->other_job_title) as $item)
                                                                        <p style="margin-bottom: 0rem;"> {{$item}}</p>
                                                                    @endforeach
                                                                @endif--}}

                                                                @php
                                                                    $str = '';
                                                                    if (!empty($savedJobseekerPofile->city_id))
                                                                        $str .= $savedJobseekerPofile->city;
                                                                    if (!empty($savedJobseekerPofile->state_id))
                                                                        $str .= ', ' . $savedJobseekerPofile->state;
                                                                    if (!empty($savedJobseekerPofile->country_id))
                                                                        $str .= ', ' . $savedJobseekerPofile->country;
                                                                @endphp

                                                                @if($str!='')
                                                                    <p style="margin-bottom: 0rem;"><i class="fa fa-map-marker"></i> {{$str}}</p>
                                                                @endif

                                                                @if($savedJobseekerPofile->phone)
                                                                    <p style="margin-bottom: 0rem;"><i class="fa fa-phone-alt"></i> {{$savedJobseekerPofile->phone}}</p>
                                                                @endif

                                                                @if($savedJobseekerPofile->email)
                                                                    <p style="margin-bottom: 0rem;"><i class="fa fa-envelope"></i> {{$savedJobseekerPofile->email}}</p>
                                                                @endif

                                                            </div>

                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="profile-right">
                                                                <p style="margin-bottom: 0rem;">Created: {{ date('M d, Y', strtotime($savedJobseekerPofile->created_at)) }}</p>
                                                               @if($savedJobseekerPofile->updated_at)
                                                                    <p style="margin-bottom: 0rem;">Updated: {{ date('M d, Y', strtotime($savedJobseekerPofile->updated_at)) }}</p>
                                                                @endif

                                                                <div class="video-resume-icon">
                                                                    @php

                                                                        $userProfileVideo = App\UserVideo::where('status','approved')->where('user_id', $savedJobseekerPofile->userId)->first();
                                                                    @endphp
                                                                    @if(isset($userProfileVideo))
                                                                        <a href="#" data-toggle="modal" data-target="#videoModal_{{$savedJobseekerPofile->userId}}">
                                                                            <i class="fas fa-video" style="font-size:25px; margin:2px 5px; color: #000;"></i>
                                                                        </a>

                                                                        <!-- Modal -->
                                                                        <div class="modal fade" id="videoModal_{{$savedJobseekerPofile->userId}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">


                                                                                        <video video controls controlsList="nodownload" width="467" height="auto" src="{{ asset('/uploads/video/'.$userProfileVideo->video) }}"></video>

                                                                                        {{--{{dd($jobSeeker->id)}}--}}
                                                                                    </div>
                                                                                    {{-- <div class="modal-footer">
                                                                                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                         <button type="button" class="btn btn-primary">Save changes</button>
                                                                                     </div>--}}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif

                                                                    @php

                                                                        $resume = App\ProfileCv::whereNotNull('cv_file')->where('user_id', $savedJobseekerPofile->userId)->first();
                                                                    @endphp
                                                                    @if(isset($resume))
                                                                        <a  href="{{route('show.resume', $savedJobseekerPofile->userId)}}">
                                                                            <i class="fas fa-file-alt" style="font-size:25px; margin:2px 5px; color: #000;"></i>
                                                                        </a>
                                                                    @endif

                                                                </div>


                                                                <div class="view-details">
                                                                    <a href="{{route('public.profile.view', $savedJobseekerPofile->userId)}}" class="view-details-btn">View Details</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                            <div class="show-profile">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="profile-img">
                                                            <div class="profile-img">
                                                                @php
                                                                    $image = (!empty($savedJobseekerPofile->image)) ? $savedJobseekerPofile->image : 'no-no-image.gif';
                                                                    $printImage= \ImgUploader::print_image("user_images/$image", '/admin_assets/no-image.png');

                                                                @endphp
                                                                {{$printImage}}
                                                            </div>

                                                        </div>


                                                    </div>
                                                    <div class="col-md-10">
                                                        <h4 style="text-align:center; padding: 46px 20px;">This profile is no longer available !</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <!-- job end -->
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    @include('includes.footer_social')
@endsection

@push('styles')

    <link href="{{asset('/')}}css/custom-bootstrap.min.css" rel="stylesheet">
@endpush

@push('scripts')

    <script type="text/javascript">
        $(document).ready(function(){
            $(".favourite_jobseeker_remove").on('click', function(){
                var element = $(this);
                var jobseeker_id = $(this).attr('data-id');
                if(jobseeker_id!= ''){
                    $.post("{{ route('delete.favourite.jobseeker') }}", {jobseeker_id: jobseeker_id,_method: 'POST', _token: '{{ csrf_token() }}'})
                        .done(function (response) {
                            $('.alert').remove();
                            if(response=='success'){
                                $(element).closest('.show-profile').remove();
                                $('.dashboard-inner').before('<div class="alert alert-success" role="alert">This Jobseeker has been removed from favourite list.</div>')
                            }
                            if(response=='error'){
                                $('.dashboard-inner').before('<div class="alert alert-danger" role="alert">This jobseeker already favourite listed.</div>')
                            }
                        });
                }
            });

        });


    </script>


    @include('includes.immediate_available_btn')
@endpush

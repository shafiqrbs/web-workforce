@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end -->
<!-- Inner Page Title start -->
@include('includes.inner_page_title')
<!-- Inner Page Title end -->

<section id="title">
    <div class="title-inner">
        <div class="container">
            <div class="imr">
                <div class="im-12">
                    <div class="title">
                        <h2>Edit Profile</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="dashboard">
    <div class="container">
        <div class="imr">
            <div class="im-12">
                <div class="dashboard-inner">
                    @include('flash::message')
                    @include('includes.user_dashboard_menu')

                    <div class="dashboard-tab-content">

                        @include('user.inc.custom-profile')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('includes.footer_social')
@endsection
@push('styles')
<style type="text/css">
    .userccount p{ text-align:left !important;}
</style>
@endpush
@push('scripts')
    <script>
    $('.profile_image_remove').on('click', function () {
        var element = $(this);
        var url = $(this).attr('data-action');
        var blankImageUrl = $(this).attr('data-image-url');
        if(confirm('Are You Sure Delete Profile Image?')){
            $.get(url, function( data ) {
                if(data.status==200){
                    element.remove();
                    $('.addedImage').attr('src',blankImageUrl);
                    // $('.addedImage').remove();
                }
            });
        }

    })
    </script>

@include('includes.immediate_available_btn')
@endpush
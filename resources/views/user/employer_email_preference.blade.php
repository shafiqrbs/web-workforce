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
                    @include('flash::message')
                    @include('includes.employer_dashboard_menu')

                    <div class="dashboard-tab-content">

                        <div class="main-body">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input style="margin-top: .05rem;" data-action="{{route('email.preference.save')}}" class="form-check-input email_preference" type="checkbox" name="email_preference" value="1" id="email_preference" {{$user->is_email_preference==1?'checked':''}}>
                                    <label class="form-check-label" for="email_preference">
                                        Receive career information, tips, news, and other marketing emails from HTT Connect.
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p style="text-align: left; color: #000;padding-top: 20px; line-height: normal!important;">Please note, HTT Connect may still send you emails for confirmations and other messages relevant to how you interact with the site.</p>
                            </div>
                        </div>

                        @if(auth()->user()->is_suspended == 1)
                            <div class="text-center mt-3 mb-5" style="color: red;">
                                <h3>Your profile is suspended. Please contact us as soon as possible !</h3>
                            </div>
                        @endif
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
        <script>
            $('.email_preference').click(function() {
                var checked = $(this).is(':checked');
                var url = $(this).attr('data-action');
                if(checked){
                  var email_preference=1;
                }else {
                    email_preference=0;
                }
                $.ajax({
                    type: "GET",
                    url: url,
                    data: { email_preference : email_preference },
                    success: function(data) {
                    },
                    error: function() {
                        alert('it broke');
                    }
                });
            });

        </script>
    @include('includes.immediate_available_btn')
    @endpush
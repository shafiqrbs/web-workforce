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
                            <div class="profile-main">
                                <div class="profile-main-top-custom">
                                    <div class="jobseeker-inner">
                                        <h2>Delete Account</h2>
                                        <div class="jobseeker-form">
                                            <div class="form-items">
                                                <h5 style="font-weight: bold;padding: 10px 0px;">Please let us know why you have decided to close your account</h5>
                                                <form id="accountDeleteForm" method="POST" action="{{ route('delete.account') }}" enctype="multipart/form-data">
                                                    {{ csrf_field() }}

                                                    @foreach($userDeleteReasons as $userDeleteReason)
                                                        @if($userDeleteReason->user_type == 'employer')
                                                        <div class="form-check pt-3" style="font-size: 1rem; color: #495057">
                                                            <input class="form-check-input account_delete_reason" type="radio" name="account_delete_reason" id="reason_id_{{$userDeleteReason->id}}" required="required" value="{{$userDeleteReason->id}}">
                                                            <label class="form-check-label pt-1" for="reason_id_{{$userDeleteReason->id}}">{{$userDeleteReason->title}}</label>
                                                        </div>
                                                        @endif



                                                    @endforeach
                                                    <div class="del">
                                                        <a href="{{route('my.profile')}}" class="cal-btn">Cancel</a>
                                                        <button type="submit" class="del-btn deleteAccount">Delete</button>
                                                    </div>


                                                </form>
                                            </div>

                                        </div>
                                    </div>
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
    <script>
        $("#accountDeleteForm").submit(function(e){
            alertMessage();
            e.preventDefault();
        });
        function alertMessage() {
            swal({
                title: "",
                text: "Are you sure you want to permanently delete your account ?",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    var id = $('input[name=account_delete_reason]:checked', '#accountDeleteForm').val();
                    var url = "{{ route('delete.account')}}";
                    $.get( url,{'id':id}, function( data ) {
                        if(data == 'success'){
                            window.location="{{ route('delete.confirm.message') }}";
                        }
                    });
                }
            });
        }
    </script>
    @include('includes.immediate_available_btn')

@endpush
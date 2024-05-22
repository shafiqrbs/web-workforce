@extends('layouts.app')
@section('content')


    <!-- explore-style-two -->
    <section class="explore-style-two sec-pad-committee-section">
        <div class="auto-container">
            <div class="sec-title centred">
                <h3 style="color: #e41e2f"><i class="flaticon-star"></i><span>{{$pageTitle}}</span><i class="flaticon-star"></i></h3>
            </div>
            @if($membersClub)
                @foreach($membersClub as $committeeType=>$members)
                    <div class="sec-title centred margin-bottom-20">
                        <h4 class="margin-bottom-10">{{$committeeType=='SERVICE'?'AFFILIATED SERVICE CLUBS':'AFFILIATED GENERAL CLUBS'}}</h4>
                        <div class="title-shape"></div>
                    </div>
                    <div class="row">
                        @foreach($members as $member)
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <td><strong>Name of Club</strong></td>
                                        <td><strong>Status</strong></td>
                                        <td><strong>Email</strong></td>
                                        <td><strong>Address</strong></td>
                                        <td><strong>District</strong></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{$member['name']}}</td>
                                        <td>{{$member['is_active']==1?'Active':'Inactive'}}</td>
                                        <td>{{$member['email']}}</td>
                                        <td>{{$member['address']}}</td>
                                        <td>{{$member['city']}}</td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        @endforeach

                    </div>
                @endforeach

            @endif
        </div>
    </section>
    <!-- explore-style-two end -->

    {{--@include('includes.footer_social')--}}
@endsection

@push('styles')

@endpush

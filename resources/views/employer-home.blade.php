@extends('layouts.app')
@section('content')
<!-- Header start -->
{{--@include('includes.header')--}}
<!-- Header end -->

@include('includes.employer_tab')

<section id="employer-background">

	<div id="dashboard">
		<div class="">
			<div class="imr">
				<div class="im-12">
					<div class="dashboard-inner">
						@include('flash::message')
						@include('includes.employer_dashboard_menu')

						<div class="dashboard-tab-content">
							<div class="profile-main">
								<div class="profile-main-top">
									<div class="edit-profile-btn">
										<a href="{{ route('my.profile') }}">Edit Profile</a>
									</div>
									<div class="profile-image">
										{{$athleteData->printAtheleteImage()}}
									</div>
									<div class="profile-details">
										<?php
//										dd($athleteData);
										?>
										<h2 style="width: 425px; padding-top: 20px;">{{$athleteData->athlete_name ? $athleteData->athlete_name : ''}}</h2>
										<ul>

											@if($athleteData->hometown)
												<li><i class="fa fa-map-marker"></i>&nbsp;&nbsp;{{$athleteData->hometown}}</li>
											@endif
											@if($athleteData->mobile)
												<li><i class="fa fa-phone"></i>&nbsp;&nbsp;{{$athleteData->mobile}}</li>
											@endif
											@if(auth()->user()->email)
												<li><i class="fa fa-envelope"></i>&nbsp;&nbsp;{{auth()->user()->email}}</li>
											@endif
										</ul>
									</div>
									<div class="created-date">
										<ul>
											<li>Created {{ $athleteData->created_at->format('j F, Y') }}</li>
											@if($athleteData->updated_at)
												<li>
													Updated {{ $athleteData->updated_at->format('j F, Y') }}
												</li>
											@endif
										</ul>
									</div>
								</div>

								@include('includes.employer_dashboard_stats')



								@if(auth()->user()->is_suspended == 1)
									<div class="text-center mt-3 mb-5" style="color: red;">
										<h3>Your profile is suspended. Please contact us as soon as possible !</h3>
									</div>
								@endif
								@if(!auth()->user()->name)
									<div class="text-center mt-3 mb-5">
										<h3 style="color: red;">Update Profile</h3>
										<p>If your profile is incomplete, please complete your profile <a style="pointer-events: {{ auth()->user()->is_suspended == 1 ? 'none' : '' }}" href="{{ route('my.profile') }}">click here</a></p>
									</div>
								@endif

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</section>









{{--@include('includes.footer_social')--}}
@endsection

@push('styles')

	<link href="{{asset('/')}}css/custom-bootstrap.min.css" rel="stylesheet">

	<style type="text/css">
/*Dashboard Start*/
		#dashboard {
			border-top: 15px solid #13549F;
		}
		.dashboard-tab {
			background: #FFFAE8;
		}
		.dashboard-inner {
			display: flex;
			flex-wrap: wrap;
			-webkit-flex-wrap: wrap;
		}

		#dashboard {
			border-top: 15px solid #13549F;
			margin-bottom: 200px;
		}
		.dashboard-tab {
			background: #FFFAE8;
			min-width: 300px;
			border-radius: 0 0 140px 140px;
			padding-top: 30px;
		}
		.dashboard-inner {
			display: flex;
		}
		.dashboard-tab-content {
			width: calc(100% - 329px);
		}
		.edit-profile-btn {
			position: absolute;
			right: 0;
			top: 0;
		}
		.edit-profile-btn a {
			display: inline-block;
			color: #FFF;
			font-weight: bold;
			font-size: 20px;
			padding: 7px 30px;
			background: #FF2E17;
			border-radius: 50px 0 0 50px;
			padding-left: 60px;
			position: relative;
		}
		.edit-profile-btn a::before {
			content: "";
			width: 18px;
			height: 18px;
			background: #FFF;
			position: absolute;
			left: 15px;
			top: 50%;
			transform: translateY(-50%);
			border-radius: 50%;
		}
		.edit-profile-btn a::after {
			content: "";
			width: 12px;
			height: 12px;
			background: #000;
			position: absolute;
			left: 27px;
			top: 50%;
			transform: translateY(-50%);
			border-radius: 50%;
		}
		.profile-main-top {
			background: #FFFAE8;
			display: flex;
			position: relative;
			align-items: center;
			padding-left: 10px;
			margin-top: 25px;
		}
		.profile-image {
			width: 20%;
			padding: 25px;
		}
		.profile-details {
			width: 100%;
		}
		.created-date {
			position: absolute;
			right: 0;
			bottom: 30px;
		}
		.profile-details h2 {
			color: #13549F;
			text-transform: uppercase;
			font-weight: bold;
		}
		.profile-details li svg {
			color: #FF2E17;
			font-weight: 300;
			font-size: 14px;
			display: inline-block;
			position: absolute;
			left: 0;
			top: 4px;
		}
		.profile-details li {
			position: relative;
			padding-left: 26px;
			font-weight: bold;
			display: block;
		}
		.created-date li {
			display: ;
			font-weight: bold;
		}
		.profile-boxs {
			display: flex;
			flex-wrap: wrap;
			-webkit-flex-wrap: wrap;
			margin-top: 30px;
			margin-left: 20px;
		}
		.single-box {
			padding: 35px 15px;
			border: 6px solid #FFF;
			border-radius: 40px;
			box-shadow: 0 0 7px rgba(0,0,0,.3);
			text-align: center;
			font-weight: bold;
			margin: 14px;
			width: calc(100% / 3 - 30px);
		}
		.single-box.sky {
			background: rgb(255,255,255);
			background: radial-gradient(circle, rgba(255,255,255,1) 0%, rgba(136,217,234,1) 92%);
		}
		.single-box h2 {
			font-weight: bold;
			color: #FF2E17;
			margin: 15px 0;
			font-size: 35px;
		}
		.single-box .active-btn {
			width: 90px;
			height: 40px;
			background: #00AB4F;
			margin: auto;
			border: 2px solid #00AB4F;
			border-radius: 3px;
			position: relative;
			transition: .3s;
			margin-bottom: 20px;
		}
		.single-box .active-btn::before {
			content: "";
			width: 48%;
			height: 100%;
			background: #FFF;
			position: absolute;
			right: 0;
			top: 50%;
			transform: translateY(-50%);
		}
		.single-box p {
			font-size: 19px;
			margin: 0;
		}
		.single-box.gray {
			background: rgb(255,255,255);
			background: radial-gradient(circle, rgba(255,255,255,1) 0%, rgba(243,213,187,1) 92%);
		}
		.single-box img {
			max-height: 55px;
			min-height: ;
		}
		.activer {
		}
		.activer h4 {
			font-weight: bold;
			font-size: 20px;
			display: inline-block;
			background: #FFF;
			padding: 15px 30px;
			border-radius: 0 50px 50px 0;
		}
		.dashboard-tab li {
			position: relative;
			display: block;
			font-weight: bold;
			font-size: 18px;
		}
		.dashboard-tab li img {
			position: absolute;
			left: 30px;
			max-width: 25px;
			top: 50%;
			transform: translateY(-50%);
		}

		.dashboard-tab li a {
			display: block;
			padding: 11px;
			padding-left: 70px;
			color: #000;
			transition: .3s;
		}
		.dashboard-tab li a:hover {
			background: #FFF;
		}

		.single-box.yellow {
			background: rgb(255,255,255);
			background: radial-gradient(circle, rgba(255,255,255,1) 0%, rgba(253,191,22,1) 92%);
		}
		.single-box.green {
			background: rgb(255,255,255);
			background: radial-gradient(circle, rgba(255,255,255,1) 0%, rgba(128,199,78,1) 92%);
		}
		/*Dashboard end*/

		.status_box{
		 display: flex!important;
		}
		.profilestat .inbox {
			text-align: center;
			background: #fff;
			padding: 15px 10px;
			margin-bottom: 30px;
			border-radius: 5px;
			flex: 1;
		}
		.profilestat .inbox i {
			font-size: 36px;
			color: #999;
			margin-bottom: 15px;
			display: block;
		}
		.profilestat .inbox h6 {
			font-size: 14px;
			font-weight: 600;
			color: #ffcb32;
			margin-bottom: 10px;
		}
		.testimonialReview{
			font-size: 25px;
			text-align: left;
		}
		.testimonialReview i{
			margin-right: 5px;
		}
		.grid-print {
			width: 100%;
			display: grid;
			grid-gap: 0;
		}
		.grid-print {
			grid-template-columns: repeat(5, calc(100%/5));
		}
	</style>

@endpush
@push('scripts')
	<script>
		function stateSelected() {
			var id = $('#stateValue').val();
			$.ajax({
				type: 'POST',
				url: '{{ route('render_cities') }}',
				data: {id, _token: '{{csrf_token()}}'},
				success: function (data) {
					$('#render_city_data').html(data['html']);
				}
			});
		}


		/*$(document).ready(function(){
			$("#click").click(function(){
				$("#advance-search").toggle();
			});
		});*/

		$(document).ready(function(){
			$("#hide").click(function(){
				$("#normal-search").hide();
				$("#advance-search").show();
			});
			$("#show").click(function(){
				$("#advance-search").hide();
				$("#normal-search").show();
			});
			$("#search-profile").click(function () {
				$("#search-show-profile").show();
			});
		});



	</script>

@include('includes.immediate_available_btn')
@endpush
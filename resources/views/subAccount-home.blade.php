@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end -->

@include('includes.employer_tab')

<section id="employer-background">

	<div id="dashboard">
		<div class="container">
			<div class="imr">
				<div class="im-12">
					<div class="dashboard-inner">
						@include('flash::message')
						@include('includes.subAccount_dashboard_menu')

						<div class="dashboard-tab-content">
							<div class="profile-main">
								<div class="profile-main-top">
									{{--<div class="edit-profile-btn">
										<a href="{{ route('my.profile') }}">Edit Profile</a>
									</div>--}}
									<div class="profile-image">
										{{auth()->user()->printUserImage()}}
									</div>
									<div class="profile-details">
										<h2 style="width: 425px; padding-top: 20px;">{{auth()->user()->name ? auth()->user()->name : ''}}</h2>
										<ul>

											@if(Auth::user()->getLocation())
												<li><i class="fa fa-map-marker"></i>{{ Auth::user()->getLocation() }}</li>
											@endif
											@if(auth()->user()->phone)
												<li><i class="fa fa-phone-alt"></i>{{auth()->user()->phone}}</li>
											@endif
											@if(auth()->user()->email)
												<li><i class="fa fa-envelope"></i>{{auth()->user()->email}}</li>
											@endif
										</ul>
									</div>
									<div class="created-date">
										<ul>
											<li>Created {{ auth()->user()->created_at->format('j F, Y') }}</li>
											@if(auth()->user()->updated_at)
												<li>
													Updated {{ auth()->user()->updated_at->format('j F, Y') }}
												</li>
											@endif
										</ul>
									</div>
								</div>

								<div class="profile-boxs">
									<div class="single-box sky">
										<div class="active-btn"></div>
										<h2>Active</h2>
										<p>Account Status</p>
									</div>
								</div>

								@if(auth()->user()->is_suspended == 1)
									<div class="text-center mt-3 mb-5" style="color: red;">
										<h3>Your profile is suspended. Please contact us as soon as possible !</h3>
									</div>
								@endif
								@if(!auth()->user()->name)
									<div class="text-center mt-3 mb-5">
										<h3 style="color: red;">Incomplete Profile!</h3>
										<p>Your profile is incomplete, please complete your profile <a style="pointer-events: {{ auth()->user()->is_suspended == 1 ? 'none' : '' }}" href="{{ route('my.profile') }}">click here</a></p>
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









@include('includes.footer_social')
@endsection

@push('styles')

	<link href="{{asset('/')}}css/custom-bootstrap.min.css" rel="stylesheet">

	<style type="text/css">

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
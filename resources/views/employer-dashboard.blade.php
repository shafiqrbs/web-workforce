@extends('layouts.app')
@section('content') 
<!-- Header start --> 
@include('includes.header') 
<!-- Header end --> 
<!-- Inner Page Title start --> 
@include('includes.inner_page_title', ['page_title'=>__('Dashboard')]) 
<!-- Inner Page Title end -->

<section id="title">
	<div class="title-inner">
		<div class="container">
			<div class="imr">
				<div class="im-12">
					<div class="title">
						<h2>Dashboard</h2>
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
					{{--@include('includes.user_dashboard_menu')--}}

					<div class="dashboard-tab">
						{{--<div class="activer">
							<div class="active-btn">
								<h4>
									@if(isset(auth()->user()->is_immediate_available))
										{{ auth()->user()->is_immediate_available == 1 ? 'Available to Work Now' : 'Not Available to Work Now' }}
									@endif
								</h4>
							</div>
						</div>--}}
						<ul>
							<li class="{{ Request::is('home') ? 'active' : ''}}">
								<a href="{{route('home')}}">
									<div class="d-icon">
										<img src="{{asset('/')}}assets/images/dash.png" alt="">
									</div>
									Dashboard
								</a>
							</li>

							<li class="{{ Request::is('edit-profile') ? 'active' : ''}}">
								<a style="pointer-events: {{ auth()->user()->is_suspended == 1 ? 'none' : '' }}" href="#">
									<div class="d-icon">
										<img src="{{asset('/')}}assets/images/ps.png" alt="">
									</div>
									My Profile
								</a>
							</li>

							<li class="{{ Request::is('profile-summary') ? 'active' : ''}}">
								<a style="pointer-events: {{ auth()->user()->is_suspended == 1 ? 'none' : '' }}" href="#">
									<div class="d-icon">
										<img src="{{asset('/')}}assets/images/ps.png" alt="">
									</div>
									Saved Searches
								</a>
							</li>

							<li class="{{ Request::is('manage-resume') ? 'active' : ''}}">
								<a style="pointer-events: {{ auth()->user()->is_suspended == 1 ? 'none' : '' }}" href="#">
									<div class="d-icon">
										<img src="{{asset('/')}}assets/images/ps.png" alt="">
									</div>
									Saved Jobseeker Profiles
								</a>
							</li>

							<li class="{{ Request::is('video') || Request::is('approval/video') ? 'active' : '' }}">
								<a style="pointer-events: {{ auth()->user()->is_suspended == 1 ? 'none' : '' }}" href="#">
									<div class="d-icon">
										<img src="{{asset('/')}}assets/images/ps.png" alt="">
									</div>
									My Payment Details
								</a>
							</li>

							<li class="{{ Request::is('user/testimonials') ? 'active' : ''}}">
								<a style="pointer-events: {{ auth()->user()->is_suspended == 1 ? 'none' : '' }}" href="#">
									<div class="d-icon">
										<img src="{{asset('/')}}assets/images/ps.png" alt="">
									</div>
									Manage Access
								</a>
							</li>

							<li class="menu-item-has-children tab-dropdown">
								<div class="d-icon"><img src="{{asset('/')}}assets/images/cog.png" alt=""><strong style="font-weight: bold">Setting</strong></div>
								<ul class="sub-menu" style="{{ Request::is('account/delete/reason') ? 'display: block;' : ''}}{{ Request::is('change/password') ? 'display: block;' : ''}}{{ Request::is('email/preference') ? 'display: block;' : ''}}">
									<li class="{{ Request::is('account/delete/reason') ? 'active' : ''}}">
										<a style="pointer-events: {{ auth()->user()->is_suspended == 1 ? 'none' : '' }}" href="{{ route('account.delete.reason') }}">
											Delete My Account
										</a>
									</li>

									<li class="{{ Request::is('change/password') ? 'active' : ''}}">
										<a style="pointer-events: {{ auth()->user()->is_suspended == 1 ? 'none' : '' }}" href="{{ route('pass.change.page') }}">
											Change Password
										</a>
									</li>

									<li class="{{ Request::is('email/preference') ? 'active' : ''}}">
										<a style="pointer-events: {{ auth()->user()->is_suspended == 1 ? 'none' : '' }}" href="{{ route('email.preference') }}">
											Email Preferences
										</a>
									</li>
								</ul>
							</li>


							<li>
								<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
									<div class="d-icon">
										<img src="{{asset('/')}}assets/images/cog.png" alt="">
									</div>
									Logout
								</a>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									{{ csrf_field() }}
								</form>
							</li>
						</ul>
					</div>

					<div class="dashboard-tab-content">
						<div class="profile-main">
							<div class="profile-main-top">
								<div class="edit-profile-btn">
									<a href="{{ route('my.profile') }}">Edit Profile</a>
								</div>
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

							@include('includes.user_dashboard_stats')

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
</section>

@include('includes.footer_social')
@endsection

@push('styles')
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
@include('includes.immediate_available_btn')
@endpush
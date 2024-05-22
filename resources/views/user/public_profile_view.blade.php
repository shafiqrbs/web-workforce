@extends('layouts.app')
@section('content')
	<!-- Header start -->
	@include('includes.header')
	<!-- Header end -->

	<section id="profile-banner">
		<div class="profile-banner-inner">
			<div class="profile-banner-bottom-inner">
				<div class="profile-banner-bottom">
					<div class="profile-banner-contents">
						<div class="profile-banner-image">
							<div class="view-profile-img">
								{{$user->printUserImage(100,175)}}
							</div>

						</div>
						<div class="profile-banner-image-contents">
							<h2>{{$user->getName()}}</h2>

							@if($user->getLocation())
								<ul>
									<li><i class="fa fa-map-marker-alt"></i> {{$user->getLocation()}}</li>
								</ul>
							@endif


						</div>
					</div>
					<div class="profile-banner-date">
						<p>Last Updated: {{$user->updated_at->format('M d, Y')}}</p>
					</div>
				</div>
			</div>
		</div>
	</section>


	<section id="dashboard">
		<div class="container">
			<div class="imr">
				<div class="im-12">
						<div class="public-double-content">
							<div class="profile-summary">
								<div class="profile-intro">
									<h3>Profile Summary</h3>

									@if(isset($userProfileVideo))
										@if($userProfileVideo->status == 'approved')
											<video controls controlsList="nodownload" width="100%" height="auto" id="vid" src="{{ asset('/uploads/video/'.$userProfileVideo->video) }}"></video>
										@endif

										{{--@if($userProfileVideo->status == 'approved')
											<div class="">
												<p style="color: red">Video Approved</p>
											</div>
										@elseif($userProfileVideo->status == 'notapproved')
											<div class="">
												<p style="color: red">Video Not Approved</p>
											</div>
										@elseif($userProfileVideo->status == 'submitted_for_approval')
											<div class="">
												<p style="color: red">Video Submitted for Approval</p>
											</div>
										@endif--}}

									@endif
								</div>

								<div class="profile-intro-contents">
									@if(isset($userResume))
										<div class="single-intro">
											<h4>Resume</h4>
											<p>
												<a  href="{{ route('show.resume', ['id'=> $user->id]) }}">
													{{ str_replace($user->id.'-', "",$userResume->cv_file) }}
												</a>
											</p>
										</div>
									@endif

									<div class="single-intro">
										<h4>Email</h4>
										<p>{{ $user->email }}</p>
									</div>

									@if(isset($user->street_address) || isset($user->postal_code))
										<div class="single-intro">
											<h4>Address</h4>
											<ul>
												@if($user->street_address)
													<li><strong>Street</strong>{{ $user->street_address }}</li>
												@endif

												@if($user->postal_code)
													<li><strong>Postal Code</strong>{{ $user->postal_code }}</li>
												@endif
											</ul>
										</div>
									@endif

									@if(isset($user->degreeLevel->degree_level))
										<div class="single-intro">
											<h4>Educational Level</h4>
											<p>{{ $user->degreeLevel->degree_level }}</p>
										</div>
									@endif

									@if($user->expected_salary)
										<div class="single-intro">
											<h4>Expected Salary</h4>
											<p>{{ $user->expected_salary }}</p>
										</div>
									@endif

									@if($userSalaryPeriod)
										<div class="single-intro">
											<h4>Salary Period</h4>
											<p>{{ $userSalaryPeriod }}</p>
										</div>
									@endif

									@if(isset($userJobTitles))
										<div class="single-intro">
											<h4>Job Titles</h4>
											@foreach($userJobTitles as $item)
												<p>{{ $item->job_title }}</p>
											@endforeach
										</div>
									@endif

									@if($user->other_job_title)
										<div class="single-intro">
											<h4>Other Job Titles</h4>
											<p>{{ $user->other_job_title }}</p>
										</div>
									@endif

									@if($userJobTypes)
										<div class="single-intro">
											<h4>Job Types</h4>
											@foreach($userJobTypes as $item)
												<p>{{ $item->job_type }}</p>
											@endforeach
										</div>
									@endif

									@if($userLanguages)
										<div class="single-intro">
											<h4>Languages</h4>
											@foreach($userLanguages as $item)
												<p>{{ $item->lang }}</p>
											@endforeach
										</div>
									@endif

									@if(isset($user->other_languages))
										<div class="single-intro">
											<h4>Other Languages</h4>
											<p>{{ $user->other_languages }}</p>
										</div>
									@endif

									<div class="additional-intro">
										<h4>Additional Information</h4>
										@if(isset($userSummary))
											<p>{{ $userSummary }}</p>
										@endif
									</div>
								</div>
							</div>

							<div class="candidate-details">
								<div class="back-to-search-list">
									<a href="{{ url()->previous() }}" class="back-to-search-btn">Back</a>
								</div>

								<h2>Candidate Detail</h2>
								<div class="c-details">
									<div class="single-c-details">
										<h3>Willing to relocate?</h3>
									</div>
									<div class="single-c-response">
										<h3>{{((bool)$user->willing_to_relocate)? 'Yes':'No'}}</h3>
									</div>
								</div>
								<div class="c-details">
									<div class="single-c-details">
										<h3>Is Profile Visible?</h3>
									</div>
									<div class="single-c-response">
										<h3>{{((bool)$user->profile_visibility)? 'Yes':'No'}}</h3>
									</div>
								</div>
								<div class="c-details">
									<div class="single-c-details">
										<h3>Telephone Number?</h3>
									</div>
									<div class="single-c-response">
										<h3>{{ $user->phone }}</h3>
									</div>
								</div>
								<div class="c-details">
									<div class="single-c-details">
										<h3>Gender</h3>
									</div>
									<div class="single-c-response">
										<h3>{{ $userGender ? $userGender : ''}}</h3>
									</div>
								</div>

								@if(isset($userExperience))
									<div class="c-details">
										<div class="single-c-details">
											<h3>Experience</h3>
										</div>
										<div class="single-c-response">
											<h3>{{ $userExperience }}</h3>
										</div>
									</div>
								@endif

								<div class="activer">
									<div class="active-btn">
										<h4>
											@if(isset($user->is_immediate_available))
												{{ $user->is_immediate_available == 1 ? 'Ready to Work Now' : 'Not Ready to Work Now' }}
											@endif
										</h4>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<?php /*$true = FALSE; */?><!--

	--><?php
/*	if(Auth::guard('company')->user()){
		$package = Auth::guard('company')->user();
		if(null!==($package)){
			$array_ids = explode(',',$package->availed_cvs_ids);
			if(in_array($user->id, $array_ids)){
				$true = TRUE;
			}
		}
	}
	*/?>

	@include('includes.footer_social')
@endsection
@push('styles')
	<style type="text/css">
		.formrow iframe {
			height: 78px;
		}
		.default-btn{
			background-color: #ffcb32;
		}
	</style>
@endpush
@push('scripts')
	<script type="text/javascript">
		$(document).ready(function () {
			$(document).on('click', '#send_applicant_message', function () {
				var postData = $('#send-applicant-message-form').serialize();
				$.ajax({
					type: 'POST',
					url: "{{ route('contact.applicant.message.send') }}",
					data: postData,
					//dataType: 'json',
					success: function (data)
					{
						response = JSON.parse(data);
						var res = response.success;
						if (res == 'success')
						{
							var errorString = '<div role="alert" class="alert alert-success">' + response.message + '</div>';
							$('#alert_messages').html(errorString);
							$('#send-applicant-message-form').hide('slow');
							$(document).scrollTo('.alert', 2000);
						} else
						{
							var errorString = '<div class="alert alert-danger" role="alert"><ul>';
							response = JSON.parse(data);
							$.each(response, function (index, value)
							{
								errorString += '<li>' + value + '</li>';
							});
							errorString += '</ul></div>';
							$('#alert_messages').html(errorString);
							$(document).scrollTo('.alert', 2000);
						}
					},
				});
			});
			showEducation();
			showProjects();
			showExperience();
			showSkills();
			showLanguages();
		});
		function showProjects()
		{
			$.post("{{ route('show.applicant.profile.projects', $user->id) }}", {user_id: {{$user->id}}, _method: 'POST', _token: '{{ csrf_token() }}'})
					.done(function (response) {
						$('#projects_div').html(response);
					});
		}
		function showExperience()
		{
			$.post("{{ route('show.applicant.profile.experience', $user->id) }}", {user_id: {{$user->id}}, _method: 'POST', _token: '{{ csrf_token() }}'})
					.done(function (response) {
						$('#experience_div').html(response);
					});
		}
		function showEducation()
		{
			$.post("{{ route('show.applicant.profile.education', $user->id) }}", {user_id: {{$user->id}}, _method: 'POST', _token: '{{ csrf_token() }}'})
					.done(function (response) {
						$('#education_div').html(response);
					});
		}
		function showLanguages()
		{
			$.post("{{ route('show.applicant.profile.languages', $user->id) }}", {user_id: {{$user->id}}, _method: 'POST', _token: '{{ csrf_token() }}'})
					.done(function (response) {
						$('#language_div').html(response);
					});
		}
		function showSkills()
		{
			$.post("{{ route('show.applicant.profile.skills', $user->id) }}", {user_id: {{$user->id}}, _method: 'POST', _token: '{{ csrf_token() }}'})
					.done(function (response) {
						$('#skill_div').html(response);
					});
		}

		function send_message() {
			const el = document.createElement('div')
			el.innerHTML = "Please <a class='btn' href='{{route('login')}}' onclick='set_session()'>log in</a> as a Employer and try again."
			@if(null!==(Auth::guard('company')->user()))
			$('#sendmessage').modal('show');
			@else
			swal({
				title: "You are not Loged in",
				content: el,
				icon: "error",
				button: "OK",
			});
			@endif
		}
		if ($("#send-form").length > 0) {
			$("#send-form").validate({
				validateHiddenInputs: true,
				ignore: "",

				rules: {
					message: {
						required: true,
						maxlength: 5000
					},
				},
				messages: {

					message: {
						required: "Message is required",
					}

				},
				submitHandler: function(form) {
					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
					@if(null !== (Auth::guard('company')->user()))
					$.ajax({
						url: "{{route('submit-message-seeker')}}",
						type: "POST",
						data: $('#send-form').serialize(),
						success: function(response) {
							$("#send-form").trigger("reset");
							$('#sendmessage').modal('hide');
							swal({
								title: "Success",
								text: response["msg"],
								icon: "success",
								button: "OK",
							});
						}
					});
					@endif
				}
			})
		}
	</script>
@endpush

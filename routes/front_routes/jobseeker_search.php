<?php

Route::get('search/job-seekers', 'Employer\JobSeekerSearchController@jobSeekersBySearch')->name('job.seeker.search');
Route::post('job-seekers/search/save', 'Employer\JobSeekerSearchController@jobSeekersSearchSave')->name('jobseeker.search.save');
Route::post('employer-save-search/remove', 'Employer\JobSeekerSearchController@deleteSaveSearch')->name('delete.save.search');


Route::post('favourite/job-seekers/save', 'Employer\JobSeekerSearchController@favouriteJobSeekersSave')->name('favourite.jobseeker.save');
Route::post('favourite/job-seekers/remove', 'Employer\JobSeekerSearchController@favouriteJobSeekersRemove')->name('delete.favourite.jobseeker');

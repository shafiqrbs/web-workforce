<?php

/* * ******  User Start ********** */
Route::get('list-users', array_merge(['uses' => 'Admin\UserController@indexUsers'], $all_users))->name('list.users');
Route::get('admin-view-athlete-profile/{id}', array_merge(['uses' => 'Admin\UserController@viewAthleteProfile'], $all_users))->name('admin.view.athlete.profile');
Route::get('admin-athlete-profile-download/{id}', array_merge(['uses' => 'Admin\UserController@athleteProfileDownload'], $all_users))->name('admin.athlete.profile.download');
Route::get('create-athlete-user', array_merge(['uses' => 'Admin\UserController@createAthletUser'], $all_users))->name('create_athlete_user');
Route::post('store-athlete-user', array_merge(['uses' => 'Admin\UserController@storeAthleteUser'], $all_users))->name('store_athlete_user');
Route::get('edit-athlete-user/{id}', array_merge(['uses' => 'Admin\UserController@editAthleteUser'], $all_users))->name('edit_athlete_user');
Route::put('update-athlete-user/{id}', array_merge(['uses' => 'Admin\UserController@updateAthleteUser'], $all_users))->name('update_athlete_user');




Route::post('store-user', array_merge(['uses' => 'Admin\UserController@storeUser'], $all_users))->name('store.user');
Route::get('edit-user/{id}', array_merge(['uses' => 'Admin\UserController@editUser'], $all_users))->name('edit.user');
Route::put('update-user/{id}', array_merge(['uses' => 'Admin\UserController@updateUser'], $all_users))->name('update.user');




Route::post('updateUser', 'Admin\UserController@updateUser')->name('updateUser');
Route::delete('delete-user', array_merge(['uses' => 'Admin\UserController@deleteUser'], $all_users))->name('delete.user');
Route::get('deleted-user', 'Admin\UserController@deletedUser')->name('list.admin.deleted_user');
Route::get('fetch-users', array_merge(['uses' => 'Admin\UserController@fetchUsersData'], $all_users))->name('fetch.data.users');
Route::put('make-active-user', array_merge(['uses' => 'Admin\UserController@makeActiveUser'], $all_users))->name('make.active.user');
Route::put('make-not-active-user', array_merge(['uses' => 'Admin\UserController@makeNotActiveUser'], $all_users))->name('make.not.active.user');
Route::put('make-verified-user', array_merge(['uses' => 'Admin\UserController@makeVerifiedUser'], $all_users))->name('make.verified.user');
Route::put('make-not-verified-user', array_merge(['uses' => 'Admin\UserController@makeNotVerifiedUser'], $all_users))->name('make.not.verified.user');


Route::get('sort-athletes', array_merge(['uses' => 'Admin\UserController@sortAthletes'], $sup_only))->name('sort.athletes');
Route::get('athletes-sort-data', array_merge(['uses' => 'Admin\UserController@athletesSortData'], $sup_only))->name('athletes.sort.data');
Route::put('athletes-sort-update', array_merge(['uses' => 'Admin\UserController@athletesSortUpdate'], $sup_only))->name('athletes.sort.update');



Route::put('make-approve-user', array_merge(['uses' => 'Admin\UserController@makeApproveUser'], $all_users))->name('make.approve.user');
Route::put('make-not-approve-user', array_merge(['uses' => 'Admin\UserController@makeNotApproveUser'], $all_users))->name('make.not.approve.user');

Route::put('make-former-athlete', array_merge(['uses' => 'Admin\UserController@makeFormerAthlete'], $all_users))->name('make.former.athlete');
Route::put('make-present-athlete', array_merge(['uses' => 'Admin\UserController@makePresentAthlete'], $all_users))->name('make.present.athlete');
/* * *********************************** */

/* * ******  Employer Start ********** */
Route::get('employer-list-users', array_merge(['uses' => 'Admin\EmployerController@indexUsers'], $all_users))->name('employer.list.users');
Route::get('employer-profile-summary/{id}', 'Admin\EmployerController@viewPublicProfile')->name('employer.view.profile');

Route::get('employer-payment-history/{id}', 'Admin\EmployerController@paymentHistory')->name('employer.payment.history');

Route::delete('delete-employee', array_merge(['uses' => 'Admin\EmployerController@deleteEmployeeByAdmin'], $all_users))->name('delete.employee');

Route::get('deleted-employer', 'Admin\EmployerController@deletedEmployer')->name('list.admin.deleted_employer');

Route::get('employer-fetch-users', array_merge(['uses' => 'Admin\EmployerController@fetchUsersData'], $all_users))->name('employer.fetch.data.users');
/* * *********************************** */

//Route::post('update-profile-summary/{id}', array_merge(['uses' => 'Admin\UserController@updateProfileSummary'], $all_users))->name('update.profile.summary');
Route::get('profile-summary/{id}', 'Admin\UserController@viewPublicProfile')->name('admin.view.profile');

/* * *********************************** */
Route::post('show-profile-cvs/{id}', array_merge(['uses' => 'Admin\UserController@showProfileCvs'], $all_users))->name('show.profile.cvs');
Route::post('upload-cv-temp-image', array_merge(['uses' => 'Admin\UserController@uploadCvTempImage'], $all_users))->name('upload.cv.temp.image');
Route::post('get-profile-cv-form/{id}', array_merge(['uses' => 'Admin\UserController@getProfileCvForm'], $all_users))->name('get.profile.cv.form');
Route::post('store-profile-cv/{id}', array_merge(['uses' => 'Admin\UserController@storeProfileCv'], $all_users))->name('store.profile.cv');
Route::post('get-profile-cv-edit-form/{user_id}', array_merge(['uses' => 'Admin\UserController@getProfileCvEditForm'], $all_users))->name('get.profile.cv.edit.form');
Route::post('update-profile-cv/{id}/{user_id}', array_merge(['uses' => 'Admin\UserController@updateProfileCv'], $all_users))->name('update.profile.cv');
Route::delete('delete-profile-cv', array_merge(['uses' => 'Admin\UserController@deleteProfileCv'], $all_users))->name('delete.profile.cv');
/* * *********************************** */
Route::post('show-profile-projects/{id}', array_merge(['uses' => 'Admin\UserController@showProfileProjects'], $all_users))->name('show.profile.projects');
Route::post('upload-project-temp-image', array_merge(['uses' => 'Admin\UserController@uploadProjectTempImage'], $all_users))->name('upload.project.temp.image');
Route::post('get-profile-project-form/{id}', array_merge(['uses' => 'Admin\UserController@getProfileProjectForm'], $all_users))->name('get.profile.project.form');
Route::post('store-profile-project/{id}', array_merge(['uses' => 'Admin\UserController@storeProfileProject'], $all_users))->name('store.profile.project');
Route::post('get-profile-project-edit-form/{user_id}', array_merge(['uses' => 'Admin\UserController@getProfileProjectEditForm'], $all_users))->name('get.profile.project.edit.form');
Route::put('update-profile-project/{id}/{user_id}', array_merge(['uses' => 'Admin\UserController@updateProfileProject'], $all_users))->name('update.profile.project');
Route::delete('delete-profile-project', array_merge(['uses' => 'Admin\UserController@deleteProfileProject'], $all_users))->name('delete.profile.project');
/* * *********************************** */
Route::post('show-profile-experience/{id}', array_merge(['uses' => 'Admin\UserController@showProfileExperience'], $all_users))->name('show.profile.experience');
Route::post('get-profile-experience-form/{id}', array_merge(['uses' => 'Admin\UserController@getProfileExperienceForm'], $all_users))->name('get.profile.experience.form');
Route::post('store-profile-experience/{id}', array_merge(['uses' => 'Admin\UserController@storeProfileExperience'], $all_users))->name('store.profile.experience');
Route::post('get-profile-experience-edit-form/{id}', array_merge(['uses' => 'Admin\UserController@getProfileExperienceEditForm'], $all_users))->name('get.profile.experience.edit.form');
Route::put('update-profile-experience/{profile_experience_id}/{user_id}', array_merge(['uses' => 'Admin\UserController@updateProfileExperience'], $all_users))->name('update.profile.experience');
Route::delete('delete-profile-experience', array_merge(['uses' => 'Admin\UserController@deleteProfileExperience'], $all_users))->name('delete.profile.experience');
/* * *********************************** */
Route::post('show-profile-education/{id}', array_merge(['uses' => 'Admin\UserController@showProfileEducation'], $all_users))->name('show.profile.education');
Route::post('get-profile-education-form/{id}', array_merge(['uses' => 'Admin\UserController@getProfileEducationForm'], $all_users))->name('get.profile.education.form');
Route::post('store-profile-education/{id}', array_merge(['uses' => 'Admin\UserController@storeProfileEducation'], $all_users))->name('store.profile.education');
Route::post('get-profile-education-edit-form/{id}', array_merge(['uses' => 'Admin\UserController@getProfileEducationEditForm'], $all_users))->name('get.profile.education.edit.form');
Route::put('update-profile-education/{education_id}/{user_id}', array_merge(['uses' => 'Admin\UserController@updateProfileEducation'], $all_users))->name('update.profile.education');
Route::delete('delete-profile-education', array_merge(['uses' => 'Admin\UserController@deleteProfileEducation'], $all_users))->name('delete.profile.education');
/* * *********************************** */
Route::post('show-profile-skills/{id}', array_merge(['uses' => 'Admin\UserController@showProfileSkills'], $all_users))->name('show.profile.skills');
Route::post('get-profile-skill-form/{id}', array_merge(['uses' => 'Admin\UserController@getProfileSkillForm'], $all_users))->name('get.profile.skill.form');
Route::post('store-profile-skill/{id}', array_merge(['uses' => 'Admin\UserController@storeProfileSkill'], $all_users))->name('store.profile.skill');
Route::post('get-profile-skill-edit-form/{id}', array_merge(['uses' => 'Admin\UserController@getProfileSkillEditForm'], $all_users))->name('get.profile.skill.edit.form');
Route::put('update-profile-skill/{skill_id}/{user_id}', array_merge(['uses' => 'Admin\UserController@updateProfileSkill'], $all_users))->name('update.profile.skill');
Route::delete('delete-profile-skill', array_merge(['uses' => 'Admin\UserController@deleteProfileSkill'], $all_users))->name('delete.profile.skill');
/* * *********************************** */
Route::post('show-profile-languages/{id}', array_merge(['uses' => 'Admin\UserController@showProfileLanguages'], $all_users))->name('show.profile.languages');
Route::post('get-profile-language-form/{id}', array_merge(['uses' => 'Admin\UserController@getProfileLanguageForm'], $all_users))->name('get.profile.language.form');
Route::post('store-profile-language/{id}', array_merge(['uses' => 'Admin\UserController@storeProfileLanguage'], $all_users))->name('store.profile.language');
Route::post('get-profile-language-edit-form/{id}', array_merge(['uses' => 'Admin\UserController@getProfileLanguageEditForm'], $all_users))->name('get.profile.language.edit.form');
Route::put('update-profile-language/{language_id}/{user_id}', array_merge(['uses' => 'Admin\UserController@updateProfileLanguage'], $all_users))->name('update.profile.language');
Route::delete('delete-profile-language', array_merge(['uses' => 'Admin\UserController@deleteProfileLanguage'], $all_users))->name('delete.profile.language');
/* * ****** End User ********** */

Route::get('profile-videos', 'Admin\UserVideoController@profileVideos')->name('list.admin.profile_video');
?>
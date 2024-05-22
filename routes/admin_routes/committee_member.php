<?php

/* * ******  ExecutiveCommitteeMember Field Start ********** */
Route::get('list-executive-committee-members', array_merge(['uses' => 'Admin\CommitteeMemberController@indexExecutiveCommitteeMembers'], $sup_only))->name('list.executive.committee.members');
Route::get('create-executive-committee-member', array_merge(['uses' => 'Admin\CommitteeMemberController@createExecutiveCommitteeMember'], $sup_only))->name('create.executive.committee.member');
Route::post('store-executive-committee-member', array_merge(['uses' => 'Admin\CommitteeMemberController@storeExecutiveCommitteeMember'], $sup_only))->name('store.executive.committee.member');
Route::get('edit-executive-committee-member/{id}/{industry_id?}', array_merge(['uses' => 'Admin\CommitteeMemberController@editExecutiveCommitteeMember'], $sup_only))->name('edit.executive.committee.member');
Route::put('update-executive-committee-member/{id}', array_merge(['uses' => 'Admin\CommitteeMemberController@updateExecutiveCommitteeMember'], $sup_only))->name('update.executive.committee.member');
Route::delete('delete-executive-committee-member', array_merge(['uses' => 'Admin\CommitteeMemberController@deleteExecutiveCommitteeMember'], $sup_only))->name('delete.executive.committee.member');
Route::get('fetch-executive-committee-members', array_merge(['uses' => 'Admin\CommitteeMemberController@fetchExecutiveCommitteeMembersData'], $sup_only))->name('fetch.data.executive.committee.members');
Route::get('sort-executive-committee-member', array_merge(['uses' => 'Admin\CommitteeMemberController@sortExecutiveCommitteeMembers'], $sup_only))->name('sort.executive.committee.members');
Route::get('executive-committee-member-sort-data', array_merge(['uses' => 'Admin\CommitteeMemberController@executiveCommitteeMemberSortData'], $sup_only))->name('executive.committee.member.sort.data');
Route::put('executive-committee-member-sort-update', array_merge(['uses' => 'Admin\CommitteeMemberController@executiveCommitteeMemberSortUpdate'], $sup_only))->name('executive.committee.member.sort.update');

Route::put('make-not-active-executive-committee', array_merge(['uses' => 'Admin\CommitteeMemberController@makeNotActiveExecutiveCommittee'], $sup_only))->name('make.not.active.executive.committee');
Route::put('make-active-executive-committee', array_merge(['uses' => 'Admin\CommitteeMemberController@makeActiveExecutiveCommittee'], $sup_only))->name('make.active.executive.committee');
/* * ****** End ExecutiveCommitteeMember Field ********** */

/* * ******  CampCommandantMember Field Start ********** */
Route::get('list-camp-commandant-members', array_merge(['uses' => 'Admin\CommitteeCampCommandantController@indexCampCommandantMembers'], $sup_only))->name('list.camp.commandant.members');
Route::get('create-camp-commandant-member', array_merge(['uses' => 'Admin\CommitteeCampCommandantController@createCampCommandantMember'], $sup_only))->name('create.camp.commandant.member');
Route::post('store-camp-commandant-member', array_merge(['uses' => 'Admin\CommitteeCampCommandantController@storeCampCommandantMember'], $sup_only))->name('store.camp.commandant.member');
Route::get('edit-camp-commandant-member/{id}/{industry_id?}', array_merge(['uses' => 'Admin\CommitteeCampCommandantController@editCampCommandantMember'], $sup_only))->name('edit.camp.commandant.member');
Route::put('update-camp-commandant-member/{id}', array_merge(['uses' => 'Admin\CommitteeCampCommandantController@updateCampCommandantMember'], $sup_only))->name('update.camp.commandant.member');
Route::delete('delete-camp-commandant-member', array_merge(['uses' => 'Admin\CommitteeCampCommandantController@deleteCampCommandantMember'], $sup_only))->name('delete.camp.commandant.member');
Route::get('fetch-camp-commandant-members', array_merge(['uses' => 'Admin\CommitteeCampCommandantController@fetchCampCommandantMembersData'], $sup_only))->name('fetch.data.camp.commandant.members');
Route::get('sort-camp-commandant-member', array_merge(['uses' => 'Admin\CommitteeCampCommandantController@sortCampCommandantMembers'], $sup_only))->name('sort.camp.commandant.members');
Route::get('camp-commandant-member-sort-data', array_merge(['uses' => 'Admin\CommitteeCampCommandantController@campCommandantMemberSortData'], $sup_only))->name('camp.commandant.member.sort.data');
Route::put('camp-commandant-member-sort-update', array_merge(['uses' => 'Admin\CommitteeCampCommandantController@campCommandantMemberSortUpdate'], $sup_only))->name('camp.commandant.member.sort.update');

Route::put('make-not-active-camp-commandant', array_merge(['uses' => 'Admin\CommitteeCampCommandantController@makeNotActiveCampCommandant'], $sup_only))->name('make.not.active.camp.commandant');
Route::put('make-active-camp-commandant', array_merge(['uses' => 'Admin\CommitteeCampCommandantController@makeActiveCampCommandant'], $sup_only))->name('make.active.camp.commandant');

/* * ****** End CampCommandantMember Field ********** */

/* * ******  OfficeAdministrationMember Field Start ********** */
Route::get('list-office-administration-members', array_merge(['uses' => 'Admin\CommitteeOfficeAdministrationController@indexOfficeAdministrationMembers'], $sup_only))->name('list.office.administration.members');
Route::get('create-office-administration-member', array_merge(['uses' => 'Admin\CommitteeOfficeAdministrationController@createOfficeAdministrationMember'], $sup_only))->name('create.office.administration.member');
Route::post('store-office-administration-member', array_merge(['uses' => 'Admin\CommitteeOfficeAdministrationController@storeOfficeAdministrationMember'], $sup_only))->name('store.office.administration.member');
Route::get('edit-office-administration-member/{id}/{industry_id?}', array_merge(['uses' => 'Admin\CommitteeOfficeAdministrationController@editOfficeAdministrationMember'], $sup_only))->name('edit.office.administration.member');
Route::put('update-office-administration-member/{id}', array_merge(['uses' => 'Admin\CommitteeOfficeAdministrationController@updateOfficeAdministrationMember'], $sup_only))->name('update.office.administration.member');
Route::delete('delete-office-administration-member', array_merge(['uses' => 'Admin\CommitteeOfficeAdministrationController@deleteOfficeAdministrationMember'], $sup_only))->name('delete.office.administration.member');
Route::get('fetch-office-administration-members', array_merge(['uses' => 'Admin\CommitteeOfficeAdministrationController@fetchOfficeAdministrationMembersData'], $sup_only))->name('fetch.data.office.administration.members');
Route::get('sort-office-administration-member', array_merge(['uses' => 'Admin\CommitteeOfficeAdministrationController@sortOfficeAdministrationMembers'], $sup_only))->name('sort.office.administration.members');
Route::get('office-administration-member-sort-data', array_merge(['uses' => 'Admin\CommitteeOfficeAdministrationController@officeAdministrationMemberSortData'], $sup_only))->name('office.administration.member.sort.data');
Route::put('office-administration-member-sort-update', array_merge(['uses' => 'Admin\CommitteeOfficeAdministrationController@officeAdministrationMemberSortUpdate'], $sup_only))->name('office.administration.member.sort.update');

Route::put('make-not-active-office-administration', array_merge(['uses' => 'Admin\CommitteeOfficeAdministrationController@makeNotActiveOfficeAdministration'], $sup_only))->name('make.not.active.office.administration');
Route::put('make-active-office-administration', array_merge(['uses' => 'Admin\CommitteeOfficeAdministrationController@makeActiveOfficeAdministration'], $sup_only))->name('make.active.office.administration');
/* * ****** End OfficeAdministrationMember Field ********** */

/* * ******  SubCommitteeMember Field Start ********** */
Route::get('list-sub-committee-members', array_merge(['uses' => 'Admin\CommitteeSubController@indexSubCommitteeMembers'], $sup_only))->name('list.sub.committee.members');
Route::get('create-sub-committee-member', array_merge(['uses' => 'Admin\CommitteeSubController@createSubCommitteeMember'], $sup_only))->name('create.sub.committee.member');
Route::post('store-sub-committee-member', array_merge(['uses' => 'Admin\CommitteeSubController@storeSubCommitteeMember'], $sup_only))->name('store.sub.committee.member');
Route::get('edit-sub-committee-member/{id}/{industry_id?}', array_merge(['uses' => 'Admin\CommitteeSubController@editSubCommitteeMember'], $sup_only))->name('edit.sub.committee.member');
Route::put('update-sub-committee-member/{id}', array_merge(['uses' => 'Admin\CommitteeSubController@updateSubCommitteeMember'], $sup_only))->name('update.sub.committee.member');
Route::delete('delete-sub-committee-member', array_merge(['uses' => 'Admin\CommitteeSubController@deleteSubCommitteeMember'], $sup_only))->name('delete.sub.committee.member');
Route::get('fetch-sub-committee-members', array_merge(['uses' => 'Admin\CommitteeSubController@fetchSubCommitteeMembersData'], $sup_only))->name('fetch.data.sub.committee.members');
Route::get('sort-sub-committee-member', array_merge(['uses' => 'Admin\CommitteeSubController@sortSubCommitteeMembers'], $sup_only))->name('sort.sub.committee.members');
Route::get('sub-committee-member-sort-data', array_merge(['uses' => 'Admin\CommitteeSubController@subCommitteeMemberSortData'], $sup_only))->name('sub.committee.member.sort.data');
Route::put('sub-committee-member-sort-update', array_merge(['uses' => 'Admin\CommitteeSubController@subCommitteeMemberSortUpdate'], $sup_only))->name('sub.committee.member.sort.update');

Route::put('make-not-active-sub-committee', array_merge(['uses' => 'Admin\CommitteeSubController@makeNotActiveSubCommittee'], $sup_only))->name('make.not.active.sub.committee');
Route::put('make-active-sub-committee', array_merge(['uses' => 'Admin\CommitteeSubController@makeActiveSubCommittee'], $sup_only))->name('make.active.sub.committee');
/* * ****** End SubCommitteeMember Field ********** */
?>
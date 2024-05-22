<?php

/* * ******  Member Field Start ********** */
Route::get('list-members', array_merge(['uses' => 'Admin\MemberController@indexMembers'], $sup_only))->name('list_members');
Route::get('create-member', array_merge(['uses' => 'Admin\MemberController@createMember'], $sup_only))->name('create_member');
Route::get('create-designation-dropdown', array_merge(['uses' => 'Admin\MemberController@designationDropdown'], $sup_only))->name('create_designation_dropdown');
Route::post('store-member', array_merge(['uses' => 'Admin\MemberController@storeMember'], $sup_only))->name('store_member');
Route::get('edit-member/{id}', array_merge(['uses' => 'Admin\MemberController@editMember'], $sup_only))->name('edit_member');
Route::put('update-member/{id}', array_merge(['uses' => 'Admin\MemberController@updateMember'], $sup_only))->name('update_member');
Route::delete('delete-member', array_merge(['uses' => 'Admin\MemberController@deleteMember'], $sup_only))->name('delete_member');
Route::put('make-not-active-member', array_merge(['uses' => 'Admin\MemberController@makeNotActiveMember'], $sup_only))->name('make_inactive_member');
Route::put('make-active-member', array_merge(['uses' => 'Admin\MemberController@makeActiveMember'], $sup_only))->name('make_active_member');
/* * ****** Member Field ********** */


Route::get('sort-ec-member', array_merge(['uses' => 'Admin\MemberController@sortECMembers'], $sup_only))->name('sort_ec_members');
Route::get('sort-ccc-member', array_merge(['uses' => 'Admin\MemberController@sortCCCMembers'], $sup_only))->name('sort_ccc_members');
Route::get('sort-oa-member', array_merge(['uses' => 'Admin\MemberController@sortOAMembers'], $sup_only))->name('sort_oa_members');
Route::get('sort-sc-member', array_merge(['uses' => 'Admin\MemberController@sortSCMembers'], $sup_only))->name('sort_sc_members');
Route::put('ec-member-sort-update', array_merge(['uses' => 'Admin\MemberController@MemberSortUpdate'], $sup_only))->name('ec_member_sort_update');

?>
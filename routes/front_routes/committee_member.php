<?php


Route::get('committee/{committee_type}', 'CommitteeMemberController@index')->name('committee.members');
Route::get('committee/details/{id}', 'CommitteeMemberController@memberDetails')->name('committee_members_detais');
Route::get('committee/details/office/{id}', 'CommitteeMemberController@memberDetailsOffice')->name('committee_members_detais_office');
